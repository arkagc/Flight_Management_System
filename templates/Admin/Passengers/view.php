<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $passenger
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading" style="font-weight:bold;"><?= __('Pages') ?></h4>
            <?= $this->Html->link(__('Dashboard'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>
            
            <?= $this->Html->link(__('Airports'), ['controller' => 'Airports', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Flights'), ['controller' => 'Flights', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Bookings'), ['controller' => 'Bookings', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Passengers List'), ['controller' => 'Passengers', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

             <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="passengers view content">
            <h3><?= h($passenger->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($passenger->username) ?></td>
                </tr>
               
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($passenger->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($passenger->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone No') ?></th>
                    <td><?= h($passenger->phone_no) ?></td>
                </tr>

                 <tr>
                    <th><?= __('Date of Birth') ?></th>
                    <td><?= h($passenger->date_of_birth->format($date_style)) ?></td>
                </tr>

                 <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($passenger->address) ?></td>
                </tr>

                 <tr>
                    <th><?= __('Country') ?></th>
                    <td><?= h($passenger->country) ?></td>
                </tr>

                 <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($passenger->state) ?></td>
                </tr>

                 <tr>
                    <th><?= __('City') ?></th>
                    <td><?= h($passenger->city) ?></td>
                </tr>

                 <tr>
                    <th><?= __('Pincode') ?></th>
                    <td><?= h($passenger->pincode) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($passenger->status) ?></td>
                </tr>
                
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($passenger->created_at->format($date_time_style)) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified At') ?></th>
                    <td><?= h($passenger->modified_at->format($date_time_style)) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
