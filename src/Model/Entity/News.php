<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * News Entity
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $cover_image
 * @property string $is_approved
 * @property int $created_by
 * @property \Cake\I18n\FrozenDate $created_on
 */
class News extends Entity
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
        'title' => true,
        'description' => true,
        'cover_image' => true,
        'is_approved' => true,
        'created_by' => true,
        'created_on' => true,
        'category' => true,
        'tags' => true,
    ];
}
