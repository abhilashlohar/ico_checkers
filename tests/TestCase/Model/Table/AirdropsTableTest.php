<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AirdropsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AirdropsTable Test Case
 */
class AirdropsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AirdropsTable
     */
    public $Airdrops;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Airdrops'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Airdrops') ? [] : ['className' => AirdropsTable::class];
        $this->Airdrops = TableRegistry::getTableLocator()->get('Airdrops', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Airdrops);

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
