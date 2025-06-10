<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersFixture
 */
class OrdersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'total_amount' => 1.5,
                'status' => 'Lorem ipsum dolor sit amet',
                'created_date' => 1744471264,
                'delivery_method' => 'Lorem ipsum dolor sit amet',
                'delivery_status' => 'Lorem ipsum dolor sit amet',
                'delivery_date' => '2025-04-13',
                'notes' => 'Lorem ipsum dolor sit amet',
                'customer_id' => 1,
            ],
        ];
        parent::init();
    }
}
