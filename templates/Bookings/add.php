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
                <legend><?= __('New Booking') ?></legend>
                <?php
                    echo $this->Form->hidden('passenger_id', array('value' => $p_id));

                    echo $this->Form->control('source_id', ['id' => 'source_id', 'empty' => '-- Select Source --', 'label' => 'Select Source', 'options' => $airports, 'onchange' => 'myFunction()']);


                    echo $this->Form->control('destination_id', ['id' => 'destination_id', 'empty' => '-- Select Destination --', 'label' => 'Select Destination','options' => $airports, 'onchange' => 'myFunction()']);

                    echo $this->Form->control('flight_id', ['id' => 'flight_id', 'empty' => '-- Select Flight No & Name --', 'options' => []]);

                    echo $this->Form->control('deperture_date', ['type' => 'text', 'id' => 'datepicker', 'placeholder' => 'Enter Deperture Date']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['id' => 'cakebtn']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- For Drop Down -->
<script type="text/javascript">
    $(document).ready(function(){
         });
        function myFunction() {   
               
                var source=$('#source_id').val();
                var destination=$('#destination_id').val();
               
                if(source!='' && destination!='')
                {
                    $.ajax({
                        type: 'POST',
                        url: '<?= $this->Url->build(['action'=>'changedropdown'])?>',
                        data: {
                            source_id:source,destination_id:destination
                        },
                        dataType:'json',
                        headers:{
                            'X-CSRF-Token':$('[name="_csrfToken"]').val()
                        },
                       

                        success: function(response) {
                          
                        
                            const arr = response;
                            if (arr.length === 0){ 
                               
                                $('#flight_id').html($("<option>").attr('value','').text('-- Select Flight No & Name --'));
                            }
                            else{
                                
                                $('#flight_id').html($("<option>").attr('value','').text('-- Select Flight No & Name --'));
                                
                                $.each(response, function(key, val){
                                
                                $('#flight_id').append($("<option>").attr('value',key).text(val));
                            });
                            }
                        },
                        
                    });
                }   
        }
</script>