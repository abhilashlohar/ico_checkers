<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style type="text/css">
    .form-signin input[type="password"]{
        margin-bottom: 0px;
    }
</style>
<?= $this->Form->create($user, ['class' => 'form-signin', 'id' => 'comment_form']) ?>
	<?= $this->Flash->render() ?>
    <?= $this->element('logo-part'); ?>
    <h2 class="h3 mb-3 font-weight-normal" style="color: #FFF;">User Registration</h2>
	<?php $option=['in'=>'In','usa'=>'usa','uk'=>'uk','uae'=>'uae'];?>
	<?= $this->Form->control('name', ['label' => false, 'class' => 'form-control', 'placeholder'=>'Full Name']); ?>
    <?= $this->Form->control('email', ['label' => false, 'class' => 'form-control', 'placeholder'=>'Email']); ?>
	<?php
    echo $this->Form->control('country_code', ['type' => 'select','options' => $country,'empty' => true,'class'=>'form-control','label'=>false,'empty'=>'-Select Country Code-']);
    ?>
	
    <?= $this->Form->control('mobile', ['label' => false, 'class' => 'form-control', 'placeholder'=>'Mobile']); ?>
    <?= $this->Form->control('password', ['label' => false, 'class' => 'form-control', 'placeholder'=>'Set Password']); ?>
    <?= $this->Form->control('confirm_password', ['label' => false, 'class' => 'form-control', 'placeholder'=>'Confirm Password','type'=>'password']); ?>
    
<<<<<<< HEAD

    	<!-- Google reCAPTCHA box -->
    	<div class="g-recaptcha" data-sitekey="6LdqIbAUAAAAAJwtzVOOpVelcHsuITQ8YK48hU51"></div>

    <?= $this->Form->button(__('Sign up'), ['class' => 'btn btn-lg btn-primary btn-block ic_button']); ?>
	<?= $this->Html->link(__('Login'), ['action' => 'login'],['class' =>'ic_link']); ?>
=======
    <?= $this->Form->button(__('Sign up'), ['class' => 'btn btn-lg btn-primary btn-block ic_button']); ?>
	<?= $this->Html->link(__('Sign in'), ['action' => 'login'],['class' =>'ic_link']); ?>
>>>>>>> d3781c713fcdb8faf47946f7461285929b1efc91
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
<?= $this->Form->end() ?>
