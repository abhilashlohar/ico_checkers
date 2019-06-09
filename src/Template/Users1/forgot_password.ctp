<?= $this->Form->create($user, ['class' => 'form-signin']) ?>
	<?= $this->Flash->render() ?>
	<?= $this->element('logo-part'); ?>
    <h1 class="h3 mb-3 font-weight-normal">Forgot Password</h1>
   
    <label for="inputEmail" class="sr-only">Email address</label>
	<?= $this->Form->control('email', ['label' => false, 'class' => 'form-control', 'placeholder' => __('Enter Email Address')]) ?>
         
   
	<?= $this->Form->button(__('Continue'), ['class' => 'btn btn-lg btn-primary btn-block ic_button']); ?>
	<?= $this->Html->link(__('Login'), ['action' => 'login'],['class' =>'ic_link']); ?> 
	<span class="ic_separator">|</span>
	<?= $this->Html->link(__('Registration'), ['action' => 'Registration'],['class' =>'ic_link']); ?> 
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
<?= $this->Form->end() ?>