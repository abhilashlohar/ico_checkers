<?php
namespace App\Model\Table;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Query;
use Cake\I18n\Time;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use ArrayObject;
/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Refers');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('name', __('Please enter a valid name.'))
            ->maxLength('name', 180, __('Name must be less than {0} characters.', 180))
            ->requirePresence('name', 'create')
            ->notEmpty('name', __('Please enter a name.'))
            ->notBlank('name', __('Please enter a valid name.'));
        
        $validator
            //->email('email', __('Please enter a valid email address.'))
            ->maxLength('email', 240, __('Email address must be less than {0} characters.', 240))
            ->requirePresence('email', 'create')
            ->notEmpty('email', __('Please enter a email address.'))
            ->add('email', 'unique', [
                'rule' => ['validateUnique', ['scope' => 'is_deleted']], 
                'provider' => 'table',
                'message' => __('Email address has already been taken. Please use a different one.')
            ]);
        
        $validator
            ->requirePresence('role', 'create')
            ->notEmpty('role', __('Please select a user role.'))
            ->notBlank('role', __('Please select a user role.'))
            ->inList('role', ['Admin', 'Editor', 'Student'], __('Please select a valid user role.'));
        
        $validator
            ->scalar('mobile', __('Please enter a valid mobile number.'))
            ->regex('mobile', '/^(\+[0-9]{1,4}[- ]{0,1})?\(?([0-9]{3})\)?[- ]{0,1}([0-9]{3})[- ]{0,1}([0-9]{4})$/i', __('Please enter a valid mobile number.'))
            ->maxLength('mobile', 21, __('Mobile number must be less than {0} characters.', 21))
			->notEmpty('mobile', __('Please enter a mobile number.'));
           // ->allowEmpty('mobile');
		   
         
			
        $validator
            ->scalar('password', __('Please enter a valid password.'))
            ->lengthBetween('password', [6, 32], __('Passwords must be between 6 and 32 characters long.'))
            ->requirePresence('password', 'create')
            ->notEmpty('password', __('Please enter a password.'))
            ->notBlank('password', __('Please enter a valid password.'));
        
        $validator
            ->scalar('confirm_password', __('Please enter a valid confirm password.'))
            ->sameAs('confirm_password', 'password', __('Password and confirm password must be same.'))
            ->notEmpty('confirm_password', __('Please enter the confirm password.'));
        
        $validator
            ->scalar('current_password', __('Please enter the valid current password.'))
            ->notEmpty('current_password', 'Please enter the current password.')
            ->add('current_password', 'matchCurrent', [
                'rule' => function($entity, $options) {
                    try
                    {
                        $user = $this->get($options['data']['id'], [
                            'fields' => ['password']
                        ]);
                        
                        if($user)
                        {
                            if((new DefaultPasswordHasher)->check($entity, $user->password))
                            {
                                return true;
                            }
                        }
                        
                        return false;
                    }
                    catch(RecordNotFoundException $e)
                    {
                        return false;
                    }
                },
                'message' => 'The password you supplied is not correct.'
            ]);
			
        $validator
            ->requirePresence('photo', 'create')
            ->notEmpty('photo', __('Please select a banner image.'), function($context) {
                return $context['newRecord'];
            })
            ->add('photo', 'fileSize', [
                'rule' => ['fileSize', '<=', '2MB'],
                'message' => __('Banner image must be less than 2MB.')
            ])
            ->add('photo', 'extension', [
                'rule' => ['extension'],
                'message' => __('Please supply a valid banner [allowed extensions are: Gif, Jpeg, Png, Jpg].')
            ]);
			
        $validator
            ->boolean('status', __('Please select a valid status.'))
            ->requirePresence('status', 'create')
            ->notEmpty('status', __('Please select a status'));

        

        return $validator;
    }
	
    public function validationForgotPassword(Validator $validator)
    {
        $validator
            ->email('email', __('Please enter a valid email address.'))
            ->maxLength('email', 240, __('Email address must be less than {0} characters.', 240))
            ->requirePresence('email')
            ->notEmpty('email', __('Please enter a email address.'));
        
        return $validator;
    }
	
	public function validationResetPassword(Validator $validator)
    {
        $validator = $this->validationDefault($validator)
            ->remove('name')
            ->remove('email', 'unique')
            ->remove('role');
        
        return $validator;
    }
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
	 public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        $formattableFields = ['dob'];
        foreach($formattableFields as $formattableField)
        {
            if(!empty($data[$formattableField]))
            {
                $fieldDate = new Time($data[$formattableField]);
                $data[$formattableField] = $fieldDate->format('Y-m-d');
            }
        }
    }
}
