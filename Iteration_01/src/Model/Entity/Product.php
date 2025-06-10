<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $stock
 * @property string $retail_price
 * @property string $wholesale_price
 * @property string $discount_percent
 * @property string $gst_percentage
 * @property string $gst_amount
 * @property string $size
 * @property string $color
 * @property int $product_category_id
 * @property string|null $image_url
 *
 * @property \App\Model\Entity\ProductCategory $product_category
 * @property \App\Model\Entity\Order[] $orders
 */
class Product extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'name' => true,
        'description' => true,
        'stock' => true,
        'retail_price' => true,
        'wholesale_price' => true,
        'discount_percent' => true,
        'gst_percentage' => true,
        'gst_amount' => true,
        'size' => true,
        'color' => true,
        'product_category_id' => true,
        'image_url' => true,
        'product_category' => true,
        'orders' => true,
    ];
}
