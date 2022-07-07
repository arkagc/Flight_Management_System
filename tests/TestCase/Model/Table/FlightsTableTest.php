<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FlightsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FlightsTable Test Case
 */
class FlightsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FlightsTable
     */
    protected $Flights;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Flights',
        'app.Sources',
        'app.Destinations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Flights') ? [] : ['className' => FlightsTable::class];
        $this->Flights = $this->getTableLocator()->get('Flights', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Flights);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
