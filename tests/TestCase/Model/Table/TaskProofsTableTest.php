<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaskProofsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaskProofsTable Test Case
 */
class TaskProofsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TaskProofsTable
     */
    public $TaskProofs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TaskProofs',
        'app.Users',
        'app.Tasks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TaskProofs') ? [] : ['className' => TaskProofsTable::class];
        $this->TaskProofs = TableRegistry::getTableLocator()->get('TaskProofs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TaskProofs);

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
