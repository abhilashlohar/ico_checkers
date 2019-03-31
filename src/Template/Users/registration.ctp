<style type="text/css">
    .form-signin input[type="password"]{
        margin-bottom: 0px;
    }
</style>
<?= $this->Form->create($user, ['class' => 'form-signin']) ?>
	 <?= $this->Flash->render() ?>
    <h2 class="h3 mb-3 font-weight-normal">User Registration</h2>

	<?= $this->Form->control('name', ['label' => false, 'class' => 'form-control', 'placeholder'=>'Full Name']); ?>
    <?= $this->Form->control('email', ['label' => false, 'class' => 'form-control', 'placeholder'=>'Email']); ?>
    <?= $this->Form->control('mobile', ['label' => false, 'class' => 'form-control', 'placeholder'=>'Mobile']); ?>
    <?= $this->Form->control('password', ['label' => false, 'class' => 'form-control', 'placeholder'=>'Set Password']); ?>
    <?= $this->Form->control('confirm_password', ['label' => false, 'class' => 'form-control', 'placeholder'=>'Confirm Password','type'=>'password']); ?>
    
    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-lg btn-primary btn-block']); ?>
	<?= $this->Html->link(__('Login'), ['action' => 'login']); ?>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
<?= $this->Form->end() ?>
