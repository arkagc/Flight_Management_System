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
        <div class="flights form content">
            <?= $this->Form->create($flight) ?>
            <fieldset>
                <legend><?= __('Add Flight') ?></legend>
                <?php
                    echo $this->Form->control('flight_no');
                    echo $this->Form->control('name');
                    echo $this->Form->control('source_id', ['options' => $airports]);
                    echo $this->Form->control('destination_id', ['options' => $airports]);
                    echo $this->Form->control('total_seat');
                    echo $this->Form->control('duration');
                    echo $this->Form->control('distance');
                    echo $this->Form->control('deprt_time');
                    echo $this->Form->control('status');
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('modified_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
