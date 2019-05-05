<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SentEmailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SentEmailsTable Test Case
 */
class SentEmailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SentEmailsTable
     */
    public $SentEmails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SentEmails',
        'app.EmailUsers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SentEmails') ? [] : ['className' => SentEmailsTable::class];
        $this->SentEmails = TableRegistry::getTableLocator()->get('SentEmails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SentEmails);

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
}
