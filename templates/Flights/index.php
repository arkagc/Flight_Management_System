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
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?php
               if(!empty($p_id)){

                    echo $this->Html->link(__('My Profile'), ['controller' => 'Passengers', 'action' => 'profile', $p_id], ['class' => 'side-nav-item']);

                    echo $this->Html->link(__('My Bookings'), ['controller' => 'Bookings', 'action' => 'booklist'], ['class' => 'side-nav-item']);

                    echo $this->Html->link(__('New Bookings'), ['controller' => 'Bookings', 'action' => 'add'], ['class' => 'side-nav-item']);
                    
                    echo $this->Html->link(__('Logout'), ['controller' => 'Passengers', 'action' => 'logout'], ['class' => 'side-nav-item']);
               }
               else{
                echo $this->Html->link(__('Sign In'), ['controller' => 'Passengers', 'action' => 'login'], ['class' => 'side-nav-item']);

                echo $this->Html->link(__('Sign Up'), ['controller' => 'Passengers', 'action' => 'register'], ['class' => 'side-nav-item']);
               }
            ?>
        </div>
    </aside>

    <div class="column-responsive column-80">
        <div class="flights index content">

    <?php 
        if(empty($p_id)){
            echo $this->Html->link(__('Book Flight'), ['controller' => 'Passengers', 'action' => 'login'], ['class' => 'button float-right']);
        } 
    ?>

    <h3><?= __('Search Flights') ?></h3>


    <!-- Serach Source and Destination -->
    <?= $this->Form->create(null, ['type' => 'post']) ?>
    
    <?= $this->Form->control('source_id', ['empty' => '-- Select Source --', 'options' => $airports, 'value' => (isset($source_session)?$source_session:'')]) ?>

    <?= $this->Form->control('destination_id', ['empty' => '-- Select Destination-- ', 'options' => $airports, 'value' => (isset($destination_session)?$destination_session:'')]) ?>

    <?= $this->Form->button(__('Search')) ?>

    <?= $this->Html->link(__('Reset'), ['controller'=>'Flights','action' => 'reset'], ['class' => 'button float-right']) ?>

    <?= $this->Form->end() ?>

    <br>
    <h3><?= __('Flights List') ?></h3>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Sl No') ?></th>
                    <th><?= $this->Paginator->sort('flight_no') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('source_id') ?></th>
                    <th><?= $this->Paginator->sort('destination_id') ?></th>
                    <th><?= $this->Paginator->sort('total_seat') ?></th>
                    <th><?= $this->Paginator->sort('duration') ?></th>
                    <th><?= $this->Paginator->sort('distance') ?></th>
                    <th><?= $this->Paginator->sort('deprt_time') ?></th>
                    
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach ($flights as $flight): ?>
                <tr>
                    <td><?= $this->Number->format($flight->id) ?></td>

                    <td><?= h($flight->flight_no) ?></td>

                    <td><?= h($flight->name) ?></td>


                    <!--Source and Destination-->
                    <td><?= $flight->has('source') ? $this->Html->link($flight->source->name, ['controller' => 'Airports', 'action' => 'view', $flight->source_id]) : '' ?></td>

                    <td><?= $flight->has('destination') ? $this->Html->link($flight->destination->name, ['controller' => 'Airports', 'action' => 'view', $flight->destination_id]) : '' ?></td>

                    <td><?= h($flight->total_seat) ?></td>

                    <td><?= h($flight->duration) ?></td>

                    <td><?= h($flight->distance) ?></td>

                    <td><?= h($flight->deprt_time->format($time_style1)) ?></td>
                
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $flight->id]) ?>
                    
                        <?php 
                            if(!empty($p_id)){
                                echo $this->Html->link(__('Book Flight'), ['controller' => 'Bookings', 'action' => 'fbookadd', $flight->id]);
                            }
                        ?>
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

