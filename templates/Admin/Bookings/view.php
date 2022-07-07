<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading" style="font-weight:bold;"><?= __('Pages') ?></h4>
            <?= $this->Html->link(__('Dashboard'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>
            
            <?= $this->Html->link(__('Airports'), ['controller' => 'Airports', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Flights'), ['controller' => 'Flights', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Passengers'), ['controller' => 'Passengers', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

             <?= $this->Html->link(__('Bookings List'), ['controller' => 'Bookings', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

             <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bookings view content">
            <h3><?= h($booking->passenger->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Passenger') ?></th>
                    <td><?= $booking->has('passenger') ? $this->Html->link($booking->passenger->name, ['controller' => 'Passengers', 'action' => 'view', $booking->passenger->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Flight No') ?></th>
                    <td><?= h($booking->flight->flight_no) ?></td>
                </tr>

                <tr>
                    <th><?= __('Flight Name') ?></th>
                    <td><?= h($booking->flight->name) ?></td>
                </tr>
                
                <tr>
                    <th><?= __('Booking Date') ?></th>
                    <td><?= h($booking->booking_date->format($date_style)) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deperture Date') ?></th>
                    <td><?= h($booking->deperture_date->format($date_style)) ?></td>
                </tr>

                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($booking->status) ?></td>
                </tr>

                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($booking->created_at->format($date_time_style)) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified At') ?></th>
                    <td><?= h($booking->modified_at->format($date_time_style)) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
