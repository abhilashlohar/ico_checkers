<?= $this->Form->create($user, ['class' => 'form-signin']) ?>
    <?= $this->Flash->render() ?>
    <?= $this->element('logo-part'); ?>
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
	<?= $this->Form->control('email', ['label' => false, 'class' => 'form-control', 'placeholder' => __(' Username'),'autocomplete'=>'on','required'=>'required']) ?>
    <label for="inputPassword" class="sr-only">Password</label>
    <?= $this->Form->control('password', ['label' => false, 'class' => 'form-control', 'placeholder' => __('Password'), 'type' => 'password','autocomplete'=>'off','required'=>'required']) ?>
    <!--<div class="checkbox mb-3">
        <label>
        <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>-->
    <?= $this->Form->button(__('Sign in'), ['class' => 'btn btn-lg btn-primary btn-block']); ?>
    <?= $this->Html->link(__('Registration'), ['action' => 'Registration']); ?> | 
	<?= $this->Html->link(__('Forgot Password?'), ['action' => 'forgotPassword']); ?> 
	
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
<?= $this->Form->end() ?>