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
                <legend><?= __('Edit Booking Status') ?></legend>
                <?php
                    echo '<label for="status">Status</label>';
                    echo $this->Form->select('status',$status);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
