<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmailUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmailUsersTable Test Case
 */
class EmailUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmailUsersTable
     */
    public $EmailUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.EmailUsers',
        'app.SentEmails',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EmailUsers') ? [] : ['className' => EmailUsersTable::class];
        $this->EmailUsers = TableRegistry::getTableLocator()->get('EmailUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmailUsers);

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
