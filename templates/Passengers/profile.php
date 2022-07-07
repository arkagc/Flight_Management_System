<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Passenger $passenger
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Flights List'), ['controller' => 'Flights', 'action' => 'index'], ['class' => 'side-nav-item']) ?>

            <?= $this->Html->link(__('My Bookings'), ['controller' => 'Bookings', 'action' => 'booklist'], ['class' => 'side-nav-item']) ?>

             <?= $this->Html->link(__('New Bookings'), ['controller' => 'Bookings', 'action' => 'add'], ['class' => 'side-nav-item']) ?>

             <?= $this->Html->link(__('Edit Profile'), ['controller' => 'Passengers', 'action' => 'edit', $passenger->id], ['class' => 'side-nav-item']) ?>

            <?= $this->Html->link(__('Logout'), ['controller' => 'Passengers', 'action' => 'logout'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="passengers view content">
            <div class="top-nav-title">
                <a><span>Profile:</span> <?php echo $passenger->name ?></a>
            </div>
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
                    <th><?= __('Date of birth') ?></th>
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
            </table>
        </div>
    </div>
</div>
