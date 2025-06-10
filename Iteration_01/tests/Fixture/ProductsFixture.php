<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductsFixture
 */
class ProductsFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'stock' => 1,
                'retail_price' => 1.5,
                'wholesale_price' => 1.5,
                'discount_percent' => 1.5,
                'gst_percentage' => 1.5,
                'gst_amount' => 1.5,
                'size' => 'Lorem ipsum dolor sit amet',
                'color' => 'Lorem ipsum dolor sit amet',
                'product_category_id' => 1,
                'image_url' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
