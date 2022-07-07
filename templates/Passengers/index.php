<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Passenger[]|\Cake\Collection\CollectionInterface $passengers
 */
?>
<div class="passengers index content">
    <h3><?= __('Passengers') ?></h3>
    
    <?= $this->Html->link(__('New Passenger'), ['action' => 'add'], ['class' => 'button float-left']) ?>

    <?= $this->Html->link(__('Logout'), ['controller' => 'Passengers', 'action' => 'logout'], ['class' => 'button float-right']) ?>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('username') ?></th>
                    <th><?= $this->Paginator->sort('password') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('phone_no') ?></th>
                    <th><?= $this->Paginator->sort('flight_id') ?></th>
                    <th><?= $this->Paginator->sort('booking_date') ?></th>
                    <th><?= $this->Paginator->sort('deperture') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('modified_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($passengers as $passenger): ?>
                <tr>
                    <td><?= $this->Number->format($passenger->id) ?></td>
                    <td><?= h($passenger->username) ?></td>
                    <td><?= h($passenger->password) ?></td>
                    <td><?= h($passenger->name) ?></td>
                    <td><?= h($passenger->email) ?></td>
                    <td><?= h($passenger->phone_no) ?></td>
                    <td><?= $passenger->has('flight') ? $this->Html->link($passenger->flight->Array, ['controller' => 'Flights', 'action' => 'view', $passenger->flight->id]) : '' ?></td>
                    <td><?= h($passenger->booking_date) ?></td>
                    <td><?= h($passenger->deperture) ?></td>
                    <td><?= h($passenger->status) ?></td>
                    <td><?= h($passenger->created_at) ?></td>
                    <td><?= h($passenger->modified_at) ?></td>
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
