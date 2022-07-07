<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Passenger[]|\Cake\Collection\CollectionInterface $passengers
 */
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
      
            <?= $this->Html->link(__('My Profile'), ['controller' => 'Passengers', 'action' => ''], ['class' => 'side-nav-item']) ?>

             <?= $this->Html->link(__('My Bookings'), ['controller' => 'Passengers', 'action' => ''], ['class' => 'side-nav-item']) ?>

            <?= $this->Html->link(__('Flights List'), ['controller' => 'Passengers', 'action' => ''], ['class' => 'side-nav-item']) ?>

            <?= $this->Html->link(__('Logout'), ['controller' => 'Passengers', 'action' => 'logout'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>

    <div class="column-responsive column-80">
        <div class="passengers index content">  
        <h3>
            <?php 
                if($login_check!=''){
                    echo $p_session_name;  
                }  
            ?>
            <?= $this->Html->link(__('New Booking'), ['controller' => 'Passengers', 'action' => 'book'], ['class' => 'button float-right']) ?>
        </h3>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('flight_No') ?></th>
                    <th><?= $this->Paginator->sort('flight_Name') ?></th>
                    <th><?= $this->Paginator->sort('booking_date') ?></th>
                    <th><?= $this->Paginator->sort('deperture_date') ?></th>
                    <th><?= $this->Paginator->sort('deperture_time') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($passengers as $passenger): ?>
                <tr>
                    <td><?= $this->Number->format($passenger->id) ?></td>
                    <td><?= $passenger->has('flight') ? $this->Html->link($passenger->flight->Array, ['controller' => 'Flights', 'action' => 'view', $passenger->flight->id]) : '' ?></td>
                    <td><?= $passenger->has('flight') ? $this->Html->link($passenger->flight->Array, ['controller' => 'Flights', 'action' => 'view', $passenger->flight->id]) : '' ?></td>
                    <td><?= h($passenger->booking_date) ?></td>
                    <td><?= h($passenger->deperture_date) ?></td>
                    <td><?= h($passenger->deperture_time) ?></td>
                    <td><?= h($passenger->status) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $passenger->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $passenger->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $passenger->id], ['confirm' => __('Are you sure you want to delete # {0}?', $passenger->id)]) ?>
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

