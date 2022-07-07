<div class="row">
	<div class="column-responsive column-100">
		<div class="top-nav-title" style="text-align: center;">
            <a><span>Welcome to</span> Admin Login</a>
    	</div>
		<?= $this->Form->create(null, [

			"url" =>[
				"controller" => "Users",
				"action" => "login"
				]
			]) 
		?>

		<?= $this->Form->control('email', ['value' => (isset($_COOKIE['email'])?$_COOKIE['email']:'')])?>

	<?= $this->Form->control('password', ['value' => (isset($_COOKIE['password'])?$_COOKIE['password']:'')]); ?>

	<?= $this->Form->checkbox('remember_me'); ?> Remember Me

	
	<?= $this->Form->submit(__('Login')) ?>	
	
		
	<?= $this->Form->end() ?>
	</div>
</div>