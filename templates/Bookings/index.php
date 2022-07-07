<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking[]|\Cake\Collection\CollectionInterface $bookings
 */
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
      
            <?= $this->Html->link(__('My Profile'), ['controller' => '', '' => ''], ['class' => 'side-nav-item']) ?>

             <?= $this->Html->link(__('My Bookings'), ['controller' => '', 'action' => ''], ['class' => 'side-nav-item']) ?>

            <?= $this->Html->link(__('Flights List'), ['controller' => '', 'action' => ''], ['class' => 'side-nav-item']) ?>

            <?= $this->Html->link(__('Logout'), ['controller' => 'Passengers', 'action' => 'logout'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>

    <div class="column-responsive column-80">
        <div class="bookings index content">
    <?= $this->Html->link(__('New Booking'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Bookings') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('passenger_id') ?></th>
                    <th><?= $this->Paginator->sort('flight_id') ?></th>
                    <th><?= $this->Paginator->sort('booking_date') ?></th>
                    <th><?= $this->Paginator->sort('deperture_date') ?></th>
                    <th><?= $this->Paginator->sort('deperture_time') ?></th>
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
                    <td><?= $booking->has('passenger') ? $this->Html->link($booking->passenger->name, ['controller' => 'Passengers', 'action' => 'view', $booking->passenger->id]) : '' ?></td>
                    <td><?= $booking->has('flight') ? $this->Html->link($booking->flight->Array, ['controller' => 'Flights', 'action' => 'view', $booking->flight->id]) : '' ?></td>
                    <td><?= h($booking->booking_date) ?></td>
                    <td><?= h($booking->deperture_date) ?></td>
                    <td><?= h($booking->deperture_time) ?></td>
                    <td><?= h($booking->status) ?></td>
                    <td><?= h($booking->created_at) ?></td>
                    <td><?= h($booking->modified_at) ?></td>
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

