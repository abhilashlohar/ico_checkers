<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SentEmail Entity
 *
 * @property int $id
 * @property string $message
 * @property \Cake\I18n\FrozenDate $create_date
 * @property string $status
 * @property \Cake\I18n\FrozenDate $sent_on
 *
 * @property \App\Model\Entity\EmailUser[] $email_users
 */
class SentEmail extends Entity
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
        'message' => true,
        'create_date' => true,
        'status' => true,
        'sent_on' => true,
        'email_users' => true
    ];
}
