<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $user
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
            
            <?= $this->Html->link(__('Bookings'), ['controller' => 'Bookings', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">

            <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'button float-right']) ?>

             <div class="top-nav-title">
                <a><span>Admin </span> Profile</a>
            </div>

            <table>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($user->created_at->format($date_time_style)) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified At') ?></th>
                    <td><?= h($user->modified_at->format($date_time_style)) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
