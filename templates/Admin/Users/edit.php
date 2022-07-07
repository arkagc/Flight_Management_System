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
        <div class="users form content">
            <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'button float-right']) ?>

            <div class="top-nav-title">
                <a><span>Edit</span> Profile</a>
            </div>
            <br>
            <?= $this->Form->create($user) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('username');
                    echo $this->Form->control('password', ['value' => '']);
                    echo $this->Form->control('email');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
