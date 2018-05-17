<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserGroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserGroupsTable Test Case
 */
class UserGroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserGroupsTable
     */
    public $UserGroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_groups',
        'app.users',
        'app.groups'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserGroups') ? [] : ['className' => UserGroupsTable::class];
        $this->UserGroups = TableRegistry::get('UserGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserGroups);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
