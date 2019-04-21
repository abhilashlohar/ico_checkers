<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $role
 * @property string|null $mobile
 * @property string $password
 * @property bool $status
 * @property bool $is_system
 * @property \Cake\I18n\FrozenTime|null $last_login
 * @property string|null $password_token
 * @property \Cake\I18n\FrozenTime|null $token_expiry
 * @property bool|null $is_deleted
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'username' => true,
        'email' => true,
        'role' => true,
        'mobile' => true,
        'password' => true,
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
		'dob' => true
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
