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

            <?= $this->Html->link(__('My profile'), ['controller' => 'Passengers', 'action' => 'profile', $passenger->id], ['class' => 'side-nav-item']) ?>

            <?= $this->Html->link(__('My Bookings'), ['controller' => 'Bookings', 'action' => 'booklist'], ['class' => 'side-nav-item']) ?>

            <?= $this->Html->link(__('New Bookings'), ['controller' => 'Bookings', 'action' => 'add'], ['class' => 'side-nav-item']) ?>

            <?= $this->Html->link(__('Flights List'), ['controller' => 'Flights', 'action' => 'index'], ['class' => 'side-nav-item']) ?>

            <?= $this->Html->link(__('Logout'), ['controller' => 'Passengers', 'action' => 'logout'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="passengers form content">
            <?= $this->Form->create($passenger) ?>
            <fieldset>
                <legend><?= __('Edit Profile') ?></legend>
                <?php
                    echo $this->Form->control('username');
                    echo $this->Form->control('password', ['value' => '']);
                    echo $this->Form->control('name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('phone_no');
                    echo $this->Form->control('date_of_birth', ['type' => 'text', 'id' => 'datepicker']);
                    echo $this->Form->control('address');

                    echo '<label for="country">Country</label>';
                    echo $this->Form->select('country',$country, ['empty' => '-- Select Country --']);
                    
                    echo '<label for="state">State</label>';
                    echo $this->Form->select('state',$state, ['empty' => '-- Select State --']);

                    echo $this->Form->control('city');
                    echo $this->Form->control('pincode');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
