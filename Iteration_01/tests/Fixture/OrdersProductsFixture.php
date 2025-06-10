<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersProductsFixture
 */
class OrdersProductsFixture extends TestFixture
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
                'quantity' => 1.5,
                'price' => 1.5,
                'order_id' => 1,
                'product_id' => 1,
            ],
        ];
        parent::init();
    }
}
