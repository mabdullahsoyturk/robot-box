<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Topic Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int $mes_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\MesType $mes_type
 * @property \App\Model\Entity\Robot[] $robots
 */
class Topic extends Entity
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
        'name' => true,
        'mes_id' => true,
        'user' => true,
        'mes_type' => true,
        'robots' => true
    ];
}
