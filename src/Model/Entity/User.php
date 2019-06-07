<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;


class User extends Entity
{

    
    protected $_accessible = [
        'name' => true,
        'username' => true,
        'email' => true,
        'role' => true,
        'mobile' => true,
        'password' => true,
        'confirm_password' => true,
        'status' => true,
        'is_system' => true,
        'last_login' => true,
        'password_token' => true,
        'token_expiry' => true,
        'is_deleted' => true,
        'created_by' => true,
        'modified_by' => true,
        'created' => true,
        'minimum_point' => true,
        'modified' => true,
        'photo' => true,
		'dob' => true,
		'country_code' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
	
	protected function _setPassword($password)
    {
        if(strlen($password) > 0)
        {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
