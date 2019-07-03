<?php


/* 
 * $paramarters => [
 *  [$searchKey, $tableField, $type, $cast, $finder, $model, $outerTableField, $subQuerySelectField, $subQueryJoin]
 * ]
 * 
 * #formFilters uses $searchKey, $tableField, $type, $cast
 * #treeFilters uses $searchKey, $tableField, $type, $model
 * #subQueryFilters uses $searchKey, $type, $finder, $model, $outerTableField, $subQuerySelectField, $subQueryJoin
 * 
 * --- $type for #treeFilters['TREELIST', 'TREELISTCURRENT'], #subQueryFilters['SUBQUERY']
 * --- $tableField: use array if `OR` condition need to be implment between different models, assocaited with same table
 */
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\I18n\Time;

class SearchComponent extends Component
{
    const SEARCH_PREFIX = 'MY_SEARCH';
    
    protected function _builtCondition($type, $tableField, $searchValue, $cast)
    {
        if($cast == 'DATE')
        {
            $tableField = 'DATE('.$tableField.')';
            
            $time = new Time($searchValue);
            $searchValue = $time->format('Y-m-d');
        }
        
        switch($type)
        {
            case 'LIKE':
                return [$tableField.' LIKE', '%'.$searchValue.'%'];
            
            case 'greaterThanOrEqual':
                return [$tableField.' >=', $searchValue];
            
            case 'lessThanOrEqual':
                return [$tableField.' <=', $searchValue];
            
            case 'SUBQUERY':
            case 'TREELIST':
            case 'TREELISTCURRENT':
                return false;
            
            case 'EQUALSORNULL':
                if($searchValue == 'NULL')
                {
                    return [$tableField.' IS', NULL];
                }
                else
                {
                    return [$tableField, $searchValue];
                }
            
            case 'EQUALS':
            default:
                return [$tableField, $searchValue];
        }
    }
    
    protected function _builtTreeCondition($model, $type, $tableField, $searchValue)
    {
        try
        {
            $query = $model->get($searchValue, [
                'fields' => ['lft', 'rght']
            ]);
            
            switch($type)
            {
                case 'TREELISTCURRENT':
                    $left = $query->lft;
                    $right = $query->rght;
                    break;
                
                case 'TREELIST':
                default:
                    $left = $query->lft + 1;
                    $right = $query->rght - 1;
            }
        }
        catch(RecordNotFoundException $e)
        {
            $left = $right = '-1';
        }
        
        $expression = function($exp, $q) use($tableField, $left, $right) {
            return $exp->between($tableField, $left, $right);
        };
        
        return $expression;
    }
    
    protected function _builtSubQueryCondition($model, $options, $outerTableField, $subQuerySelectField, $finder)
    {
        $subQuery = $model->find($finder, $options)
            ->select([$subQuerySelectField])
            ->distinct();
        
        $expression = function($exp, $q) use($outerTableField, $subQuery) {
            return $exp->in($outerTableField, $subQuery);
        };
        
        return $expression;
    }
    
    public function formFilters($conditionKey, array $paramarters = [])
    {
        $conditions = [];
        
        if($this->request->is('post') && $this->request->getParam('action') != 'move' && $this->request->getData('formAction') != 'updateOnSame')
        {
            $this->request->session()->delete(static::SEARCH_PREFIX.'.'.$conditionKey.'._conditions');
            
            foreach($paramarters as $paramarter)
            {
                $this->request->session()->delete(static::SEARCH_PREFIX.'.'.$conditionKey.'.data.'.$paramarter[0]);
                
                $searchValue = $this->request->getData($paramarter[0]);
                if($searchValue != '')
                {
                    if(is_array($paramarter[1]))
                    {
                        $orConditions = [];
                        foreach($paramarter[1] as $tableField)
                        {
                            $condition = $this->_builtCondition($paramarter[2], $tableField, $searchValue, $paramarter[3]);
                            if($condition)
                            {
                                $orConditions[$condition['0']] = $condition[1];
                            }
                        }
                        
                        if(!empty($orConditions))
                        {
                            $conditions[] = ['OR' => $orConditions];
                        }
                    }
                    else
                    {
                        $condition = $this->_builtCondition($paramarter[2], $paramarter[1], $searchValue, $paramarter[3]);
                        if($condition)
                        {
                            $conditions[$condition['0']] = $condition['1'];
                        }
                    }
                    
                    $this->request->session()->write(static::SEARCH_PREFIX.'.'.$conditionKey.'.data.'.$paramarter[0], $searchValue);
                }
            }
            
            $this->request->session()->write(static::SEARCH_PREFIX.'.'.$conditionKey.'._conditions', $conditions);
        }
        else
        {
            $conditions = $this->request->session()->read(static::SEARCH_PREFIX.'.'.$conditionKey.'._conditions');
            
            foreach($paramarters as $paramarter)
            {
                $this->request = $this->request->withData($paramarter[0], $this->request->session()->read(static::SEARCH_PREFIX.'.'.$conditionKey.'.data.'.$paramarter[0]));
            }
        }
        
        $treeParamarters = array_filter($paramarters, function($element) {
            return isset($element[2]) && in_array($element[2], ['TREELIST', 'TREELISTCURRENT']);
        });
        
        foreach($treeParamarters as $paramarter)
        {
            $searchValue = $this->request->getData($paramarter[0]);
            if($searchValue != '')
            {
                $conditionTree = $this->_builtTreeCondition($paramarter[5], $paramarter[2], $paramarter[1], $searchValue);
                
                if($conditionTree)
                {
                    $conditions[] = $conditionTree;
                }
            }
        }
        
        $subQueryParamarters = array_filter($paramarters, function($element) {
            return isset($element[2]) && in_array($element[2], ['SUBQUERY']);
        });
        
        $filterSubQueryParamarters = [];
        foreach($subQueryParamarters as $paramarter)
        {
            $tableField = $paramarter[0];
            $searchValue = $this->request->getData($paramarter[0]);
            if($searchValue != '')
            {
                if($paramarter[3] == 'DATE')
                {
                    $tableField = 'CAST DATE '.$tableField;
                    
                    $time = new Time($searchValue);
                    $searchValue = $time->format('Y-m-d');
                }
                
                $flag = false;
                foreach($filterSubQueryParamarters as $key => $value)
                {
                    if(($paramarter[5] == $value[0]) && ($paramarter[6] == $value[1]) && 
                        ($paramarter[7] == $value[2]) && ($paramarter[4] == $value[3]))
                    {
                        $flag = true;
                        $filterSubQueryParamarters[$key] = [$paramarter[5], $paramarter[6], $paramarter[7], $paramarter[4], $value[4]+[implode(' ', array_filter([$tableField, $paramarter[8]], function($value){ return $value !== '';})) => $searchValue]];
                    }
                }
                
                if(!$flag)
                {
                    $filterSubQueryParamarters[] = [$paramarter[5], $paramarter[6], $paramarter[7], $paramarter[4], [implode(' ', array_filter([$tableField, $paramarter[8]], function($value){ return $value !== '';})) => $searchValue]];
                }
            }
        }
        
        foreach($filterSubQueryParamarters as $paramarter)
        {
            if(is_array($paramarter[3]))
            {
                $orConditions = [];
                foreach($paramarter[3] as $finder)
                {
                    $conditionOrSubQuery = $this->_builtSubQueryCondition($paramarter[0], $paramarter[4], $paramarter[1], $paramarter[2], $finder);
                    if($conditionOrSubQuery)
                    {
                        $orConditions[] = $conditionOrSubQuery;
                    }
                }
                
                if(!empty($orConditions))
                {
                    $conditionSubQuery = ['OR' => $orConditions];
                }
            }
            else
            {
                $conditionSubQuery = $this->_builtSubQueryCondition($paramarter[0], $paramarter[4], $paramarter[1], $paramarter[2], $paramarter[3]);
            }
            
            if($conditionSubQuery)
            {
                $conditions[] = $conditionSubQuery;
            }
        }
        
        return $conditions;
    }
    
    public function formFiltersFront($conditionKey, array $paramarters = [])
    {
        $conditions = [];
        
        if(($this->request->is('post') || $this->request->is('get')) && $this->request->getParam('action') != 'move' && $this->request->getData('formAction') != 'updateOnSame')
        {
            $this->request->session()->delete(static::SEARCH_PREFIX.'.'.$conditionKey.'._conditions');
            
            foreach($paramarters as $paramarter)
            {
                $this->request->session()->delete(static::SEARCH_PREFIX.'.'.$conditionKey.'.data.'.$paramarter[0]);
                
                if(!empty($this->request->getQuery())){
                    $searchValue = $this->request->getQuery($paramarter[0]);
                }else{
                    $searchValue = $this->request->getData($paramarter[0]);
                }
                if($searchValue != '')
                {
                    if(is_array($paramarter[1]))
                    {
                        $orConditions = [];
                        foreach($paramarter[1] as $tableField)
                        {
                            $condition = $this->_builtCondition($paramarter[2], $tableField, $searchValue, $paramarter[3]);
                            if($condition)
                            {
                                $orConditions[$condition['0']] = $condition[1];
                            }
                        }
                        
                        if(!empty($orConditions))
                        {
                            $conditions[] = ['OR' => $orConditions];
                        }
                    }
                    else
                    {
                        $condition = $this->_builtCondition($paramarter[2], $paramarter[1], $searchValue, $paramarter[3]);
                        if($condition)
                        {
                            $conditions[$condition['0']] = $condition['1'];
                        }
                    }
                    
                    $this->request->session()->write(static::SEARCH_PREFIX.'.'.$conditionKey.'.data.'.$paramarter[0], $searchValue);
                }
            }
            
            $this->request->session()->write(static::SEARCH_PREFIX.'.'.$conditionKey.'._conditions', $conditions);
        }
        else
        {
            $conditions = $this->request->session()->read(static::SEARCH_PREFIX.'.'.$conditionKey.'._conditions');
            
            foreach($paramarters as $paramarter)
            {
                $this->request = $this->request->withData($paramarter[0], $this->request->session()->read(static::SEARCH_PREFIX.'.'.$conditionKey.'.data.'.$paramarter[0]));
            }
        }
        
        $treeParamarters = array_filter($paramarters, function($element) {
            return isset($element[2]) && in_array($element[2], ['TREELIST', 'TREELISTCURRENT']);
        });
        
        foreach($treeParamarters as $paramarter)
        {
             if(!empty($this->request->getQuery())){
                    $searchValue = $this->request->getQuery($paramarter[0]);
                }else{
            $searchValue = $this->request->getData($paramarter[0]);
                }
            if($searchValue != '')
            {
                $conditionTree = $this->_builtTreeCondition($paramarter[5], $paramarter[2], $paramarter[1], $searchValue);
                
                if($conditionTree)
                {
                    $conditions[] = $conditionTree;
                }
            }
        }
        
        $subQueryParamarters = array_filter($paramarters, function($element) {
            return isset($element[2]) && in_array($element[2], ['SUBQUERY']);
        });
        
        $filterSubQueryParamarters = [];
        foreach($subQueryParamarters as $paramarter)
        {
            $tableField = $paramarter[0];
             if(!empty($this->request->getQuery())){
                    $searchValue = $this->request->getQuery($paramarter[0]);
                }else{
            $searchValue = $this->request->getData($paramarter[0]);
                }
            if($searchValue != '')
            {
                if($paramarter[3] == 'DATE')
                {
                    $tableField = 'CAST DATE '.$tableField;
                    
                    $time = new Time($searchValue);
                    $searchValue = $time->format('Y-m-d');
                }
                
                $flag = false;
                foreach($filterSubQueryParamarters as $key => $value)
                {
                    if(($paramarter[5] == $value[0]) && ($paramarter[6] == $value[1]) && 
                        ($paramarter[7] == $value[2]) && ($paramarter[4] == $value[3]))
                    {
                        $flag = true;
                        $filterSubQueryParamarters[$key] = [$paramarter[5], $paramarter[6], $paramarter[7], $paramarter[4], $value[4]+[implode(' ', array_filter([$tableField, $paramarter[8]], function($value){ return $value !== '';})) => $searchValue]];
                    }
                }
                
                if(!$flag)
                {
                    $filterSubQueryParamarters[] = [$paramarter[5], $paramarter[6], $paramarter[7], $paramarter[4], [implode(' ', array_filter([$tableField, $paramarter[8]], function($value){ return $value !== '';})) => $searchValue]];
                }
            }
        }
        
        foreach($filterSubQueryParamarters as $paramarter)
        {
            if(is_array($paramarter[3]))
            {
                $orConditions = [];
                foreach($paramarter[3] as $finder)
                {
                    $conditionOrSubQuery = $this->_builtSubQueryCondition($paramarter[0], $paramarter[4], $paramarter[1], $paramarter[2], $finder);
                    if($conditionOrSubQuery)
                    {
                        $orConditions[] = $conditionOrSubQuery;
                    }
                }
                
                if(!empty($orConditions))
                {
                    $conditionSubQuery = ['OR' => $orConditions];
                }
            }
            else
            {
                $conditionSubQuery = $this->_builtSubQueryCondition($paramarter[0], $paramarter[4], $paramarter[1], $paramarter[2], $paramarter[3]);
            }
            
            if($conditionSubQuery)
            {
                $conditions[] = $conditionSubQuery;
            }
        }
        
        return $conditions;
    }
    
    public function resetFilters($conditionKey)
    {
        $this->request->session()->delete(static::SEARCH_PREFIX.'.'.$conditionKey.'._conditions');
        $this->request->session()->delete(static::SEARCH_PREFIX.'.'.$conditionKey.'.data');
    }
}
