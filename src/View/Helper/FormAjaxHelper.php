<?php
/**
 * @author: Sonia Solanki
 * @date: March 01, 2018
 * @version: 1.0.0
 */
namespace App\View\Helper;

use Cake\View\Helper\FormHelper;

class FormAjaxHelper extends FormHelper
{
    public function postLink($title, $url = null, array $options = [])
    {
        $options += ['block' => null, 'confirm' => null];
        
        $requestMethod = 'POST';
        if (!empty($options['method'])) {
            $requestMethod = strtoupper($options['method']);
            unset($options['method']);
        }
        
        $confirmMessage = $options['confirm'];
        unset($options['confirm']);
        
        $formName = str_replace('.', '', uniqid('post_', true));
        $formOptions = [
            'name' => $formName,
            'style' => 'display:none;',
            'method' => 'post',
        ];
        if (isset($options['target'])) {
            $formOptions['target'] = $options['target'];
            unset($options['target']);
        }
        $templater = $this->templater();
        
        $restoreAction = $this->_lastAction;
        $this->_lastAction($url);
        
        $action = $templater->formatAttributes([
            'action' => $this->Url->build($url),
            'escape' => false
        ]);
        
        $out = $this->formatTemplate('formStart', [
            'attrs' => $templater->formatAttributes($formOptions) . $action
        ]);
        $out .= $this->hidden('_method', [
            'value' => $requestMethod,
            'secure' => static::SECURE_SKIP
        ]);
        $out .= $this->_csrfField();
        
        $fields = [];
        if (isset($options['data']) && is_array($options['data'])) {
            foreach (Hash::flatten($options['data']) as $key => $value) {
                $fields[$key] = $value;
                $out .= $this->hidden($key, ['value' => $value, 'secure' => static::SECURE_SKIP]);
            }
            unset($options['data']);
        }
        $out .= $this->secure($fields);
        $out .= $this->formatTemplate('formEnd', []);
        $this->_lastAction = $restoreAction;
        
        if ($options['block']) {
            if ($options['block'] === true) {
                $options['block'] = __FUNCTION__;
            }
            $this->_View->append($options['block'], $out);
            $out = '';
        }
        unset($options['block']);
        
        $url = 'javascript:void(0);';
        $onClick = 'postLinkAjax("' . $formName . '");';
        if ($confirmMessage) {
            $options['onclick'] = $this->_confirm($confirmMessage, $onClick, '', $options);
        } else {
            $options['onclick'] = $onClick . ' ';
        }
        $options['onclick'] .= 'event.returnValue = false; return false;';
        
        $out .= $this->Html->link($title, $url, $options);
        
        return $out;
    }
    
    public function pickerControl()
    {
        $picker = ''/*$this->Html->tag('span', $this->button(
            $this->Html->tag('i', '', ['class' => 'fa fa-times']), ['class'=>'btn btn-sm default date-reset', 'type' => 'button']), ['class' => 'input-group-btn'])*/;
        $picker .= $this->Html->tag('span', $this->button(
            $this->Html->tag('i', '', ['class' => 'icon-calendar']), ['class'=>'btn default date-set', 'type' => 'button']), ['class' => 'input-group-btn']);
        
        return $picker;
    }
    
    public function fileControl()
    {
        $container = $this->Html->tag('span', ' ', ['class' => 'fileinput-filename']);
        $virtualInput = $this->Html->tag('div', $container, 
            ['class' => 'form-control uneditable-input input-fixed', 'data-trigger' => 'fileinput']);
        
        $buttons = $this->Html->tag('span', __('Browse'), ['class' => 'fileinput-new']);
        $buttons .= $this->Html->tag('span', __('Change'), ['class' => 'fileinput-exists']);
        
        $control = $this->Html->link(__('Remove'), 'javascript:void(0);', ['class' => 'input-group-addon btn red fileinput-exists', 'data-dismiss' => 'fileinput']);
        
        return compact('virtualInput', 'buttons', 'control');
    }
}
