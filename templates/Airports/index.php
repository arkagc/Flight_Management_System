<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Airport[]|\Cake\Collection\CollectionInterface $airports
 */
?>
<div class="airports index content">
    <?= $this->Html->link(__('New Airport'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Airports') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('short_name') ?></th>
                    <th><?= $this->Paginator->sort('location') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('modified_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($airports as $airport): ?>
                <tr>
                    <td><?= $this->Number->format($airport->id) ?></td>
                    <td><?= h($airport->name) ?></td>
                    <td><?= h($airport->short_name) ?></td>
                    <td><?= h($airport->location) ?></td>
                    <td><?= h($airport->status) ?></td>
                    <td><?= h($airport->created_at) ?></td>
                    <td><?= h($airport->modified_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $airport->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $airport->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $airport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $airport->id)]) ?>
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
