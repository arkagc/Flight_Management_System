<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>

            <?= $this->Html->link(__('My Profile'), ['controller' => 'Passengers', 'action' => 'profile', $p_id], ['class' => 'side-nav-item']) ?>

             <?= $this->Html->link(__('My Bookings'), ['controller' => 'Bookings', 'action' => 'booklist'], ['class' => 'side-nav-item']) ?>

             <?= $this->Html->link(__('Flights List'), ['controller' => 'Flights', 'action' => 'index'], ['class' => 'side-nav-item']) ?>

            <?= $this->Html->link(__('Logout'), ['controller' => 'Passengers', 'action' => 'logout'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bookings view content">
          
            <table>
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

            </table>
        </div>
    </div>
</div>
