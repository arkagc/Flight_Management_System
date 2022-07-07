<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
             <h4 class="heading" style="font-weight:bold;"><?= __('Pages') ?></h4>
            <?= $this->Html->link(__('Dashboard'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>
            
            <?= $this->Html->link(__('Airports'), ['controller' => 'Airports', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Flights'), ['controller' => 'Flights', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

            <?= $this->Html->link(__('Passengers'), ['controller' => 'Passengers', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

             <?= $this->Html->link(__('Bookings List'), ['controller' => 'Bookings', 'action' => 'index'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>

             <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'side-nav-item', 'style' => 'color:#d33c43; font-weight:bold;']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bookings form content">
            <?= $this->Form->create($booking) ?>
            <fieldset>
                <legend><?= __('Edit Booking') ?></legend>
                <?php
                echo $this->Form->control('source_id', ['id' => 'source_id', 'empty' => '-- Select Source --', 'label' => 'Select Source', 'options' => $airports, 'onchange' => 'myFunction()']);

                echo $this->Form->control('destination_id', ['id' => 'destination_id', 'empty' => '-- Select Destination --', 'label' => 'Select Destination','options' => $airports, 'onchange' => 'myFunction()']);

                    echo $this->Form->control('flight_id', ['id' => 'flight_id', 'options' => $flights]);

                    echo $this->Form->control('passenger_id', ['options' => $passengers, 'disabled' => 'disabled']);
                    
                    echo $this->Form->control('deperture_date', ['type' => 'text', 'id' => 'datepicker']);
                    
                    echo '<label for="status">Status</label>';
                    echo $this->Form->select('status',$status, ['empty' => '-- Select Status --']);
                   
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
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