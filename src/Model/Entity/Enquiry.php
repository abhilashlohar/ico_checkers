<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Enquiry extends Entity
{
    protected $_accessible = [
        'name' => true,
        'email' => true,
        'phone' => true,
        'subject' => true,
        'message' => true,
        'type' => true,
        'course_id' => true,
        'reason' => true,
        'state_id' => true,
        'city_id' => true,
        'open' => true,
        '*' => false
    ];
}
