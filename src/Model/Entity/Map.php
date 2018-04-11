<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Map Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $width
 * @property int $height
 * @property int $space
 * @property int $x_zero
 * @property int $y_zero
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Robot[] $robots
 */
class Map extends Entity
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
        'width' => true,
        'height' => true,
        'space' => true,
        'x_zero' => true,
        'y_zero' => true,
        'user' => true,
        'robots' => true
    ];
}
