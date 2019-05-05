<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IcosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IcosTable Test Case
 */
class IcosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\IcosTable
     */
    public $Icos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Icos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Icos') ? [] : ['className' => IcosTable::class];
        $this->Icos = TableRegistry::getTableLocator()->get('Icos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Icos);

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
