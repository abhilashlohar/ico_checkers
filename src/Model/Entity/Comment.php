<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comment Entity
 *
 * @property int $id
 * @property int $news_id
 * @property string $comment
 * @property int $user_id
 * @property string $backlink
 * @property string $user_website
 *
 * @property \App\Model\Entity\User $user
 */
class Comment extends Entity
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
        'news_id' => true,
        'comment' => true,
        'user_id' => true,
        'backlink' => true,
        'user_website' => true,
    ];
}
