<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Airport[]|\Cake\Collection\CollectionInterface $airports
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading" style="font-weight:bold;"><?= __('Pages') ?></h4>
            <?= $this->Html->link(__('Dashboard'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Flights'), ['controller' => 'Flights', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Passengers'), ['controller' => 'Passengers', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Bookings'), ['controller' => 'Bookings', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

             <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>
        </div>
    </aside>

    <div class="column-responsive column-90">
        <div class="airports index content">

            <div class="top-nav-title">
                <a><span>Airport</span> Details</a>
            </div>
            <br>
            <?= $this->Html->link(__('Add New Airport'), ['action' => 'add'], ['class' => 'button float-left']) ?>

            <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'button float-right']) ?>

            

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
                        <td>
                            <?php 
                                if($airport->status == 'Y'){
                                    echo 'Active';
                                }
                                else{
                                    echo 'Inactive';
                                } 
                            ?>
                        </td>
                        <td><?= h($airport->created_at->format($date_time_style)) ?></td>
                        <td><?= h($airport->modified_at->format($date_time_style)) ?></td>
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
    </div>
</div>

