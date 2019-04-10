<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Refer Entity
 *
 * @property int $id
 * @property int $ref_by_user_id
 * @property int $ref_to_user_id
 * @property \Cake\I18n\FrozenTime $created_date
 * @property float $points
 *
 * @property \App\Model\Entity\RefByUser $ref_by_user
 * @property \App\Model\Entity\RefToUser $ref_to_user
 */
class Refer extends Entity
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
        'ref_by_user_id' => true,
        'ref_to_user_id' => true,
        'created_date' => true,
        'points' => true,
    ];
}
