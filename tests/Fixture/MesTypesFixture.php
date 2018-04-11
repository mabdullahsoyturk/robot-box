<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MesTypesFixture
 *
 */
class MesTypesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf16_turkish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'x_par' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf16_turkish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'y_par' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf16_turkish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        't_par' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf16_turkish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'mes_types_ibfk_1' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf16_turkish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'user_id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'x_par' => 'Lorem ipsum dolor sit amet',
            'y_par' => 'Lorem ipsum dolor sit amet',
            't_par' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
