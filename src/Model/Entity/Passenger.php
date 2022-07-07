<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Passenger Entity
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $password
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone_no
 * @property \Cake\I18n\FrozenDate|null $date_of_birth
 * @property string|null $address
 * @property string|null $country
 * @property string|null $state
 * @property string|null $city
 * @property string|null $pincode
 * @property string $status
 * @property \Cake\I18n\FrozenTime|null $created_at
 * @property \Cake\I18n\FrozenTime $modified_at
 *
 * @property \App\Model\Entity\Booking[] $bookings
 * @property \App\Model\Entity\Flight $flight
 * @property \App\Model\Entity\Airport $airport
 */
class Passenger extends Entity
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
        'username' => true,
        'password' => true,
        'name' => true,
        'email' => true,
        'phone_no' => true,
        'date_of_birth' => true,
        'address' => true,
        'country' => true,
        'state' => true,
        'city' => true,
        'pincode' => true,
        'status' => true,
        'created_at' => true,
        'modified_at' => true,
        'bookings' => true,
        'flight' => true,
        'airport' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    protected function _setPassword($password){
        return (new DefaultPasswordHasher)->hash($password);
    }
}
