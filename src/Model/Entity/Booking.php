<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Booking Entity
 *
 * @property int $id
 * @property int $passenger_id
 * @property int $flight_id
 * @property \Cake\I18n\FrozenDate|null $booking_date
 * @property \Cake\I18n\FrozenDate|null $deperture_date
 * @property \Cake\I18n\FrozenTime|null $deperture_time
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $modified_at
 *
 * @property \App\Model\Entity\Passenger $passenger
 * @property \App\Model\Entity\Flight $flight
 */
class Booking extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'passenger_id' => true,
        'flight_id' => true,
        'booking_date' => true,
        'deperture_date' => true,
        'status' => true,
        'created_at' => true,
        'modified_at' => true,
        'passenger' => true,
        'flight' => true,
    ];
}
