<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Withdraw Entity
 *
 * @property int $id
 * @property int $user_id
 * @property float $points
 * @property \Cake\I18n\FrozenTime $created_on
 * @property string $is_money_transfered
 *
 * @property \App\Model\Entity\User $user
 */
class Withdraw extends Entity
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
        'user_id' => true,
        'points' => true,
        'created_on' => true,
        'is_money_transfered' => true,
        'user' => true
    ];
}
