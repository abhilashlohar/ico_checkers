<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TaskProof Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $message
 * @property string $image
 * @property int $task_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Task $task
 */
class TaskProof extends Entity
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
        'message' => true,
        'image' => true,
        'task_id' => true,
        'user' => true,
        'task' => true
    ];
}
