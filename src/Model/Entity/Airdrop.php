<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Airdrop Entity
 *
 * @property int $id
 * @property string $name
 * @property string $link
 * @property string $country
 * @property string $email
 * @property \Cake\I18n\FrozenTime $applied_on
 */
class Airdrop extends Entity
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
        'link' => true,
        'country' => true,
        'email' => true,
        'applied_on' => true,
        'description' => true,
        'comment' => true,
        'project_quality' => true,
        'strangeness' => true,
        'different_ico' => true,
        'actual_use' => true,
        'team' => true,
		'*' => false
    ];
}
