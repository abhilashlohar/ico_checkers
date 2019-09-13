<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MdiCoinsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MdiCoinsTable Test Case
 */
class MdiCoinsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MdiCoinsTable
     */
    public $MdiCoins;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MdiCoins',
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
        $config = TableRegistry::getTableLocator()->exists('MdiCoins') ? [] : ['className' => MdiCoinsTable::class];
        $this->MdiCoins = TableRegistry::getTableLocator()->get('MdiCoins', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MdiCoins);

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
