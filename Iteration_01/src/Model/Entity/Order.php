<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property string $total_amount
 * @property string $status
 * @property \Cake\I18n\DateTime $created_date
 * @property string|null $delivery_method
 * @property string|null $delivery_status
 * @property \Cake\I18n\Date|null $delivery_date
 * @property string|null $notes
 * @property string|null $stripe_payment_id
 * @property int $customer_id
 *
 * @property \App\Model\Entity\Product[] $products
 */
class Order extends Entity
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
        'total_amount' => true,
        'status' => true,
        'created_date' => true,
        'delivery_method' => true,
        'delivery_status' => true,
        'delivery_date' => true,
        'notes' => true,
         'stripe_payment_id' => true,
        'customer_id' => true,
        'products' => true,
    ];
}
