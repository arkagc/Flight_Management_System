<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flight $flight
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading" style="font-weight:bold;"><?= __('Pages') ?></h4>
            <?= $this->Html->link(__('Dashboard'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Airports'), ['controller' => 'Airports', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Passengers'), ['controller' => 'Passengers', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Bookings'), ['controller' => 'Bookings', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Flight List'), ['controller' => 'Flights', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

             <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="flights view content">
            <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'button float-right']) ?>
            
            <div class="top-nav-title">
                <a><span>View </span> Flight</a>
            </div>

            <table>
                <tr>
                    <th><?= __('Flight No') ?></th>
                    <td><?= h($flight->flight_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($flight->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Source') ?></th>
                    <td><?= $flight->has('source') ? $this->Html->link($flight->source->name, ['controller' => 'Airports', 'action' => 'view', $flight->source->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Destination') ?></th>
                    <td><?= $flight->has('destination') ? $this->Html->link($flight->destination->name, ['controller' => 'Airports', 'action' => 'view', $flight->destination->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Seat') ?></th>
                    <td><?= h($flight->total_seat) ?></td>
                </tr>
                <tr>
                    <th><?= __('Distance') ?></th>
                    <td><?= h($flight->distance) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td>
                        <?php 
                            if($flight->status == 'Y'){
                                echo 'Active';
                            }
                            else{
                                echo 'Inactive';
                            } 
                        ?>
                    </td>
                </tr>
               
                <tr>
                    <th><?= __('Duration') ?></th>
                    <td><?= h($flight->duration) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deprt Time') ?></th>
                    <td><?= h($flight->deprt_time->format($time_style1)) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($flight->created_at->format($date_time_style)) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified At') ?></th>
                    <td><?= h($flight->modified_at->format($date_time_style)) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
