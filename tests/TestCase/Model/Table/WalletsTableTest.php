<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WalletsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WalletsTable Test Case
 */
class WalletsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WalletsTable
     */
    public $Wallets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Wallets',
        'app.Users',
        'app.News',
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
        $config = TableRegistry::getTableLocator()->exists('Wallets') ? [] : ['className' => WalletsTable::class];
        $this->Wallets = TableRegistry::getTableLocator()->get('Wallets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Wallets);

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
