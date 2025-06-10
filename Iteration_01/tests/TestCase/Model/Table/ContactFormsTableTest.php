<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContactFormsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactFormsTable Test Case
 */
class ContactFormsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ContactFormsTable
     */
    protected $ContactForms;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.ContactForms',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ContactForms') ? [] : ['className' => ContactFormsTable::class];
        $this->ContactForms = $this->getTableLocator()->get('ContactForms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ContactForms);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ContactFormsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
