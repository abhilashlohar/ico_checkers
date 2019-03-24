<?= $this->Form->create($user, ['class' => 'form-signin']) ?>
    <h2>User Registration</h2>

    <label for="inputEmail" class="sr-only">Email address</label>
	 <?= $this->Form->control('name', ['label' => ['text' => __('Name'), 'class' => 'control-label'], 'class' => 'form-control']); ?>
    <label for="inputPassword" class="sr-only">Password</label>
    
    <?= $this->Form->control('email', ['label' => ['text' => __('Email'), 'class' => 'control-label'], 'class' => 'form-control']) ?>
	<?= $this->Form->control('mobile', ['label' => ['text' => __('Mobile'), 'class' => 'control-label'], 'class' => 'form-control']); ?>
	<?= $this->Form->control('password', ['label' => ['text' => __('Password'), 'class' => 'control-label'], 'class' => 'form-control', 'templateVars' => ['labelIcon' => __('Password')]]) ?>
	<?= $this->Form->control('confirm_password', ['label' => ['text' => __('Confirm Password'), 'class' => 'control-label'], 'class' => 'form-control', 'type' => 'password']) ?>
    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-lg btn-primary btn-block']); ?>
	<?= $this->Html->link(__('Login'), ['action' => 'login']); ?>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
<?= $this->Form->end() ?>