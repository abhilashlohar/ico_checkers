<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MdiCoin Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $conis
 * @property string $module
 * @property int|null $task_id
 * @property int|null $referred_user
 * @property string $meta_description
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime $date_modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Task $task
 */
class MdiCoin extends Entity
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
        'coins' => true,
        'module' => true,
        'task_id' => true,
        'referred_user' => true,
        'meta_description' => true,
        'date_created' => true,
        'date_modified' => true,
        'user' => true,
        'task' => true
    ];
}
