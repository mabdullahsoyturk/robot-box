<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MesType Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $x_par
 * @property string $y_par
 * @property string $t_par
 * @property bool $is_public_message_type
 *
 * @property \App\Model\Entity\User $user
 */
class MesType extends Entity
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
        'x_par' => true,
        'y_par' => true,
        't_par' => true,
        'is_public_message_type' => true,
        'user' => true
    ];
}
