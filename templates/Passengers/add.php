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
            <?= $this->Html->link(__('List Passengers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
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
                    echo $this->Form->control('flight_id', ['options' => $flights]);
                    echo $this->Form->control('booking_date', ['empty' => true]);
                    echo $this->Form->control('deperture', ['empty' => true]);
                    echo $this->Form->control('status');
                    echo $this->Form->control('created_at', ['empty' => true]);
                    echo $this->Form->control('modified_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
