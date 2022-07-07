<div class="row">
	<aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
      
            <?= $this->Html->link(__('Flights List'), ['controller' => 'Flights', 'action' => 'index'], ['class' => 'side-nav-item']) ?>

            <?= $this->Html->link(__('Login'), ['controller' => 'Passengers', 'action' => 'login'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>

    <div class="column-responsive column-80">
    	<div class="top-nav-title" style="margin: 0 0 0 300px;">
            <a><span>Registration</span> Form</a>
    	</div>
    	<?=
		$this->Form->create($passenger, [
			"url" => [
				"controller" => "Passengers",
				"action" => "register"
			]
		])
		?>

		<?=
		$this->Form->control('username')
		?>

		<?=
		$this->Form->control('password')
		?>

		<?=
		$this->Form->control('name')
		?>

		<?=
		$this->Form->control('email')
		?>

		<?=
		$this->Form->control('phone_no')
		?>

		<?=
		$this->Form->control('date_of_birth', ['type' => 'text', 'id' => 'datepicker']);
		?>

		<?php
		echo '<label for="address">Address</label>';
		echo $this->Form->textarea('address');
		?>

		<?php
		echo '<label for="country">Country</label>';
   		echo $this->Form->select('country',$country, ['empty' => '-- Select Country --']);
		?>

		<?php
		echo '<label for="state">State</label>';
   		echo $this->Form->select('state',$state, ['empty' => '-- Select State --']);
		?>

		<?=
		$this->Form->control('city')
		?>

		<?=
		$this->Form->control('pincode')
		?>

		<?=
		$this->Form->submit(__('Submit'))
		?>

		<?=
		$this->Form->end()
		?>
    </div>
</div>




