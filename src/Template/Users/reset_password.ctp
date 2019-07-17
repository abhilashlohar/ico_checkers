<?php
// author: ManojTanwar
?>


<?= $this->Form->create($user, ['class' => 'form-signin']) ?>
    <?= $this->Flash->render() ?>
    <?= $this->element('logo-part'); ?>
    <h2 class="h3 mb-3 font-weight-normal" style="color: #FFF;">Reset passwordss</h2>
   
    <label for="inputEmail" class="sr-only">Email address</label>
	<?= $this->Form->control('password', ['label' => ['text' => __('New Password')], 'class' => 'form-control', 'placeholder' => __('New Password'),'label'=>false]) ?>
	<?= $this->Form->control('confirm_password', ['label' => ['text' => __('Confirm Password')], 'class' => 'form-control ', 'placeholder' => __('Confirm Password'), 'type' => 'password','label'=>false]) ?>
   
	<?= $this->Form->button(__('Reset Password'), ['class' => 'btn btn-lg btn-primary btn-block']); ?>
	<?= $this->Html->link(__('Login'), ['action' => 'login']); ?>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
<?= $this->Form->end() ?>
