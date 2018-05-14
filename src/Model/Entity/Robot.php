<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Robot Entity
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property string $ip_address
 * @property string $port
 * @property int $topic_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Topic $topic
 */
class Robot extends Entity
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
        'user_id' => true,
        'ip_address' => true,
        'port' => true,
        'topic_id' => true,
        'user' => true,
        'topic' => true
    ];
}
