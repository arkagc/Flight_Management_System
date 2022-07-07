<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Flight Entity
 *
 * @property int $id
 * @property string|null $flight_no
 * @property string|null $name
 * @property int $source_id
 * @property int $destination_id
 * @property string|null $total_seat
 * @property \Cake\I18n\FrozenTime $duration
 * @property string|null $distance
 * @property \Cake\I18n\FrozenTime $deprt_time
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $modified_at
 *
 * @property \App\Model\Entity\Source $source
 * @property \App\Model\Entity\Destination $destination
 */
class Flight extends Entity
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
        'flight_no' => true,
        'name' => true,
        'source_id' => true,
        'destination_id' => true,
        'total_seat' => true,
        'duration' => true,
        'distance' => true,
        'deprt_time' => true,
        'status' => true,
        'created_at' => true,
        'modified_at' => true,
        'source' => true,
        'destination' => true,
    ];
}
