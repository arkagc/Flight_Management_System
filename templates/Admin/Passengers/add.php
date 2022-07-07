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
        <div class="passengers form content">
            <?= $this->Form->create($passenger) ?>
            <fieldset>
                <legend><?= __('Add Passenger') ?></legend>
                <?php
                    echo $this->Form->control('username');
                    echo $this->Form->control('password');
                    echo $this->Form->control('name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('phone_no');
                    echo $this->Form->control('date_of_birth', ['type' => 'text', 'id' => 'datepicker']);
                    echo '<label for="address">Address</label>';
                    echo $this->Form->textarea('address');
                    echo '<label for="country">Country</label>';
                    echo $this->Form->select('country',$country, ['empty' => '-- Select Country --']);
                    echo '<label for="state">State</label>';
                    echo $this->Form->select('state',$state, ['empty' => '-- Select State --']);
                    echo $this->Form->control('city');
                    echo $this->Form->control('pincode');
                    echo '<label for="status">Status</label>';
                    echo $this->Form->select('status',$status);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
