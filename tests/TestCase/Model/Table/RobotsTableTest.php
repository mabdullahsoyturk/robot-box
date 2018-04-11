<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RobotsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RobotsTable Test Case
 */
class RobotsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RobotsTable
     */
    public $Robots;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.robots',
        'app.users',
        'app.topics',
        'app.mes_types',
        'app.maps'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Robots') ? [] : ['className' => RobotsTable::class];
        $this->Robots = TableRegistry::get('Robots', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Robots);

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
