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
        <div class="bookings form content">
            <?= $this->Form->create($booking) ?>
            <fieldset>
                <legend><?= __('New Booking') ?></legend>
                <?php
               
                    echo $this->Form->hidden('passenger_id', array('value' => $p_id));
                    echo $this->Form->hidden('flight_id', array('value' => $flight_id));

                    echo $this->Form->control('source_id', ['type' => 'text', 'value' => $flight_source_name, 'disabled' => 'disabled']);

                    echo $this->Form->control('destination_id', ['type' => 'text', 'value' => $flight_destination_name, 'disabled' => 'disabled']);

                    echo $this->Form->control('flight_No', ['type' => 'text', 'value' => $flight->flight_no, 'disabled' => 'disabled']);

                    echo $this->Form->control('flight_Name', ['type' => 'text', 'value' => $flight->name, 'disabled' => 'disabled']);

                    echo $this->Form->control('deperture_date', ['type' => 'text', 'id' => 'datepicker', 'placeholder' => 'Enter Deperture Date']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

