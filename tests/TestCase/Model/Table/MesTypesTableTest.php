<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MesTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MesTypesTable Test Case
 */
class MesTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MesTypesTable
     */
    public $MesTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.mes_types',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MesTypes') ? [] : ['className' => MesTypesTable::class];
        $this->MesTypes = TableRegistry::get('MesTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MesTypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
