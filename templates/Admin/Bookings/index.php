<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking[]|\Cake\Collection\CollectionInterface $bookings
 */

$session = $this->getRequest()->getSession();
if($session->check('source_data')){
    // Final value of source in session
    $source_session = $session->read('source_data');    
}
if($session->check('destination_data')){
    // Final value of destination in session
    $destination_session = $session->read('destination_data');    
}
if($session->check('booking_to_data')){
    // Final value of destination in session
    $booking_to_session = $session->read('booking_to_data');    
}
if($session->check('booking_from_data')){
    // Final value of destination in session
    $booking_from_session = $session->read('booking_from_data');    
}
if($session->check('booking_status_data')){
    // Final value of destination in session
    $status_session = $session->read('booking_status_data');    
}

?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading" style="font-weight:bold;"><?= __('Pages') ?></h4>
            <?= $this->Html->link(__('Dashboard'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>
            
            <?= $this->Html->link(__('Airports'), ['controller' => 'Airports', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Flights'), ['controller' => 'Flights', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Passengers'), ['controller' => 'Passengers', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

             <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>
        </div>
    </aside>

    <div class="column-responsive column-90">
        <div class="bookings index content">
            <?= $this->Html->link(__('New Booking'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Bookings') ?></h3>

    <?= $this->Form->create(null, ['type' => 'post']) ?>

     <!--Search by Source -->
    <?= $this->Form->control('source_id', ['empty' => '-- Select Source --', 'label' => 'Select Source', 'options' => $airports, 'value' => (isset($source_session)?$source_session:'')]) ?>

    <!--Search by Destination -->
    <?= $this->Form->control('destination_id', ['empty' => '-- Select Destination --', 'label' => 'Select Destination','options' => $airports, 'value' => (isset($destination_session)?$destination_session:'')]) ?>

    <!--Search by Booking Date to  -->
    <?= $this->Form->control('booking_date_to', ['label' => 'Select Booking Date To', 'type' => 'date', 'value' => (isset($booking_to_session)?$booking_to_session:'')]) ?>

    <!--Search by Booking Date from  -->
    <?= $this->Form->control('booking_date_from', ['label' => 'Select Booking Date From', 'type' => 'date', 'value' => (isset($booking_from_session)?$booking_from_session:'')]) ?>

    <!--Search by Status-->
    <?php 
   $options = ['Booked' => 'Booked', 'Cancelled' => 'Cancelled', 'Waiting' => 'Waiting'];

   echo '<label for="search_status">Select Status</label>';
   echo $this->Form->select('search_status', $options, ['empty' => '-- Select Status --', 'value' => (isset($status_session)?$status_session:'')]);
   ?>

    <?= $this->Form->button(__('Search')) ?>

    <?= $this->Html->link(__('Reset'), ['controller'=>'Bookings','action' => 'reset'], ['class' => 'button float-right']) ?>

    <?= $this->Form->end() ?>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('passenger_id') ?></th>
                    <th><?= $this->Paginator->sort('flight_no') ?></th>
                    <th><?= $this->Paginator->sort('flight_name') ?></th>
                    <th><?= $this->Paginator->sort('booking_date') ?></th>
                    <th><?= $this->Paginator->sort('deperture_date') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('modified_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?= $this->Number->format($booking->id) ?></td>

                    <td><?= h($booking->passenger->name) ?></td>

                    <td><?= h($booking->flight->flight_no) ?></td>

                    <td><?= h($booking->flight->name) ?></td>

                    <td><?= h($booking->booking_date->format($date_style)) ?></td>

                    <td><?= h($booking->deperture_date->format($date_style)) ?></td>

                    <td><?= h($booking->status) ?></td>

                    <td><?= h($booking->created_at->format($date_time_style)) ?></td>

                    <td><?= h($booking->modified_at->format($date_time_style)) ?></td>

                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $booking->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $booking->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $booking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $booking->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
    </div>
</div>

