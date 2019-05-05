<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Wallet Entity
 *
 * @property int $id
 * @property int $user_id
 * @property float $point
 * @property string $reason
 * @property \Cake\I18n\FrozenTime $transaction_date
 * @property int $news_id
 * @property int $task_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\News $news
 * @property \App\Model\Entity\Task $task
 */
class Wallet extends Entity
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
        'point' => true,
        'reason' => true,
        'transaction_date' => true,
        'news_id' => true,
        'task_id' => true,
        'user' => true,
        'news' => true,
        'task' => true
    ];
}
