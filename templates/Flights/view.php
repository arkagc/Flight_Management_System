<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flight $flight
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Flights'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="flights view content">
            <span><h3 style="float: left;"><?= h($flight->flight_no) ?></h3> <h3 style="float: right;"><?= h($flight->name) ?></h3></span>
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
                    <th><?= __('Total Seat') ?></th>
                    <td><?= h($flight->total_seat) ?></td>
                </tr>

                <tr>
                    <th><?= __('Source') ?></th>
                   <td><?= $flight->has('source') ? $this->Html->link($flight->source->name, ['controller' => 'Airports', 'action' => 'view', $flight->source_id]) : '' ?></td>

                </tr>
                <tr>
                    <th><?= __('Destination') ?></th>
                   <td><?= $flight->has('destination') ? $this->Html->link($flight->destination->name, ['controller' => 'Airports', 'action' => 'view', $flight->destination_id]) : '' ?></td>

                </tr>

                <tr>
                    <th><?= __('Distance') ?></th>
                    <td><?= h($flight->distance) ?></td>
                </tr>
                
                <tr>
                    <th><?= __('Duration') ?></th>
                    <td><?= h($flight->duration) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deprt Time') ?></th>
                    <td><?= h($flight->deprt_time->format($time_style1)) ?></td>
                </tr>

            </table>
        </div>
    </div>
</div>
