<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Appointment Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property \Cake\I18n\DateTime $created_date
 * @property \Cake\I18n\DateTime $scheduled_date
 * @property string $address
 * @property string $status
 * @property string $notes
 * @property int $service_id
 *
 * @property \App\Model\Entity\Service $service
 */
class Appointment extends Entity
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
        'email' => true,
        'phone' => true,
        'created_date' => true,
        'scheduled_date' => true,
        'address' => true,
        'status' => true,
        'notes' => true,
        'service_id' => true,
        'service' => true,
    ];
}
