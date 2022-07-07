<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $passengers
 */

$session = $this->getRequest()->getSession();
if($session->check('data')){
    // Final value of source in session
    $session_name_email_phone_no = $session->read('data');    
}

?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading" style="font-weight:bold;"><?= __('Pages') ?></h4>
            <?= $this->Html->link(__('Dashboard'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>
            
            <?= $this->Html->link(__('Airports'), ['controller' => 'Airports', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Flights'), ['controller' => 'Flights', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Bookings'), ['controller' => 'Bookings', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

             <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>
        </div>
    </aside>

    <div class="column-responsive column-90">
        <div class="passengers index content">
    <?= $this->Html->link(__('New Passenger'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Passengers') ?></h3>

    
    <?= $this->Form->create(null, ['type' => 'post']) ?>
    
    <!--Search by name and email and phone no-->
    <?= $this->Form->control('search_name_email_phone_no', ['label' => 'Type Name / Email / Phone', 'type' => 'text', 'value' => (isset($session_name_email_phone_no)?$session_name_email_phone_no:'')]) ?>

    <?= $this->Form->button(__('Search')) ?>
    <?= $this->Html->link(__('Reset'), ['controller'=>'Passengers','action' => 'reset'], ['class' => 'button float-right']) ?>

    <?= $this->Form->end() ?>


    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('username') ?></th>
                    
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('phone_no') ?></th>
                    <th><?= $this->Paginator->sort('date_of_birth') ?></th>
                    <th><?= $this->Paginator->sort('address') ?></th>
                    <th><?= $this->Paginator->sort('country') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th><?= $this->Paginator->sort('city') ?></th>
                    <th><?= $this->Paginator->sort('pincode') ?></th>
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
                   
                    <td><?= h($passenger->name) ?></td>
                    <td><?= h($passenger->email) ?></td>
                    <td><?= h($passenger->phone_no) ?></td>
                    <td><?= h($passenger->date_of_birth->format($date_style)) ?></td>
                    <td><?= h($passenger->address) ?></td>
                    <td><?= h($passenger->country) ?></td>
                    <td><?= h($passenger->state) ?></td>
                    <td><?= h($passenger->city) ?></td>
                    <td><?= h($passenger->pincode) ?></td>
                    <td><?= h($passenger->status) ?></td>
                    <td><?= h($passenger->created_at->format($date_time_style)) ?></td>
                    <td><?= h($passenger->modified_at->format($date_time_style)) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Bookings'), ['controller' => 'Bookings', 'action' => 'pbooklist', $passenger->id]) ?>
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

