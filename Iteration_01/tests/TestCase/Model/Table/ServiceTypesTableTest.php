<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ServiceTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ServiceTypesTable Test Case
 */
class ServiceTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ServiceTypesTable
     */
    protected $ServiceTypes;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.ServiceTypes',
        'app.Services',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ServiceTypes') ? [] : ['className' => ServiceTypesTable::class];
        $this->ServiceTypes = $this->getTableLocator()->get('ServiceTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ServiceTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ServiceTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
