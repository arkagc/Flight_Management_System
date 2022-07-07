<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flight[]|\Cake\Collection\CollectionInterface $flights
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

?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
             <h4 class="heading" style="font-weight:bold;"><?= __('Pages') ?></h4>
            <?= $this->Html->link(__('Dashboard'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Airports'), ['controller' => 'Airports', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Passengers'), ['controller' => 'Passengers', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Bookings'), ['controller' => 'Bookings', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

             <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>
        </div>
    </aside>

    <div class="column-responsive column-90">
        <div class="flights index content">

            <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'button float-right']) ?>
            <?= $this->Html->link(__('Add New Flight'), ['action' => 'add'], ['class' => 'button float-left']) ?>
            <br>
            <br>
            <div class="top-nav-title">
                <a><span>Flight</span> Details</a>
            </div>
            <br>

    <!-- Serach Source and Destination -->
    <?= $this->Form->create(null, ['type' => 'post']) ?>
    
    <?= $this->Form->control('source_id', ['empty' => '-- Select Source --', 'options' => $airports, 'value' => (isset($source_session)?$source_session:'')]) ?>

    <?= $this->Form->control('destination_id', ['empty' => '-- Select Destination --', 'options' => $airports, 'value' => (isset($destination_session)?$destination_session:'')]) ?>

    <?= $this->Form->button(__('Search')) ?>

    <?= $this->Html->link(__('Reset'), ['controller'=>'Flights','action' => 'reset'], ['class' => 'button float-right']) ?>

    <?= $this->Form->end() ?>


    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('flight_no') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('source_id') ?></th>
                    <th><?= $this->Paginator->sort('destination_id') ?></th>
                    <th><?= $this->Paginator->sort('total_seat') ?></th>
                    <th><?= $this->Paginator->sort('duration') ?></th>
                    <th><?= $this->Paginator->sort('distance') ?></th>
                    <th><?= $this->Paginator->sort('deprt_time') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('modified_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flights as $flight): ?>
                <tr>
                    <td><?= $this->Number->format($flight->id) ?></td>
                    <td><?= h($flight->flight_no) ?></td>
                    <td><?= h($flight->name) ?></td>
                    <td><?= $flight->has('source') ? $this->Html->link($flight->source->name, ['controller' => 'Airports', 'action' => 'view', $flight->source->id]) : '' ?></td>
                    
                    <td><?= $flight->has('destination') ? $this->Html->link($flight->destination->name, ['controller' => 'Airports', 'action' => 'view', $flight->destination->id]) : '' ?></td>
                    <td><?= h($flight->total_seat) ?></td>
                    <td><?= h($flight->duration) ?></td>
                    <td><?= h($flight->distance) ?></td>
                    <td><?= h($flight->deprt_time->format($time_style1)) ?></td>
                    <td>
                        <?php 
                            if($flight->status == 'Y'){
                                echo 'Active';
                            }
                            else{
                                echo 'Inactive';
                            } 
                        ?>
                    </td>
                    <td><?= h($flight->created_at->format($date_time_style)) ?></td>
                    <td><?= h($flight->modified_at->format($date_time_style)) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $flight->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $flight->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $flight->id], ['confirm' => __('Are you sure you want to delete # {0}?', $flight->id)]) ?>
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
