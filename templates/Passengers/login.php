<div class="row">
	<aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
      
            <?= $this->Html->link(__('Flights List'), ['controller' => 'Flights', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>

    <div class="column-responsive column-80">
    	<div class="top-nav-title" style="text-align: center;">
            <a><span>Sign</span> In</a>
    	</div>
    	<?=
		$this->Form->create(null, [
			"url" => [
				"controller" => "Passengers",
				"action" => "login"
			]
		])
		?>

		<?= $this->Form->control('email_or_phone_no', ['value' => (isset($_COOKIE['email_or_phone_no'])?$_COOKIE['email_or_phone_no']:'')]) ?>

		<?= $this->Form->control('password', ['value' => (isset($_COOKIE['password'])?$_COOKIE['password']:'')]) ?>

		<?= $this->Form->checkbox('remember_me'); ?> Remember Me

        <?= 
			$this->Form->submit(__('Login'), ['class' => 'float-left'])
		?>

		<div class="float-right">
			<?= $this->Html->link(__('Register'), ['controller' => 'Passengers', 'action' => 'register'], ['class' => 'button']),  ' New User? Click Register' ?>	
		</div>
		

		<?= $this->Form->end() ?>
    </div>
</div>

