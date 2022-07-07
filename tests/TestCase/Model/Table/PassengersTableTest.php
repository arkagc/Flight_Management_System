<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PassengersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PassengersTable Test Case
 */
class PassengersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PassengersTable
     */
    protected $Passengers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Passengers',
        'app.Bookings',
        'app.Flights',
        'app.Airports',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Passengers') ? [] : ['className' => PassengersTable::class];
        $this->Passengers = $this->getTableLocator()->get('Passengers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Passengers);

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
