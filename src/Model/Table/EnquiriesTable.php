<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class EnquiriesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->addBehavior('Timestamp');
       
        
    }
    
    public function validationDefault(Validator $validator)
    {
       $validator
            ->scalar('name', __('Please enter a valid name.'))
            ->maxLength('name', 180, __('Name must be less than {0} characters.', 180))
            ->requirePresence('name', 'create')
            ->notEmpty('name', __('Please enter a name.'))
            ->notBlank('name', __('Please enter a valid name.'));
        
        $validator
            ->email('email', false, __('Please enter a valid email address.'))
            ->maxLength('email', 240, __('Email address must be less than {0} characters.', 240))
            ->requirePresence('email', 'create')
            ->notEmpty('email', __('Please enter a email address.'));
        
        $validator
            ->scalar('phone', __('Please enter a valid phone number.'))
            ->regex('phone', '/^(\+[0-9]{1,4}[- ]{0,1})?\(?([0-9]{3})\)?[- ]{0,1}([0-9]{3})[- ]{0,1}([0-9]{4})$/i', __('Please enter a valid phone number.'))
            ->maxLength('phone', 21, __('Mobile number must be less than {0} characters.', 21))
            ->requirePresence('phone', 'create')
            ->notEmpty('phone', __('Please enter a phone number.'));
        
        $validator
            ->scalar('institute_id', __('Please select a valid institute.'))
            ->notEmpty('institute_id', __('Please select a institute.'));
        
        $validator
            ->scalar('course_id', __('Please select a valid course.'))
            ->notEmpty('course_id', __('Please select a course.'));
        
        $validator 
             ->allowEmpty('message');
        
        return $validator;
    }
    
    public function validationSubscribe(Validator $validator)
    {
        $validator = $this->validationDefault($validator)
            ->remove('name')
            ->remove('phone');
       
        return $validator;
    }
    
  
}
