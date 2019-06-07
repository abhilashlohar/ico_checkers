<?php
$this->Html->script(['gijgo.min'], ['block' => true]); 
$this->Html->css(['gijgo.min'], ['block' => true]); ?>
<div class="container">
    <h1>Edit Profile</h1>
  	<hr>
	<?= $this->Form->create($user, ['type' => 'file','class'=>'form-horizontal','role'=>'form']); ?>
	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <?= $this->Html->Image(($user->photo!='')?str_replace('\\','/',$user->photo):'//placehold.it/100',['class'=>'avatar img-circle','alt'=>$user->name,'width'=>'125','height'=>'125']);?>
          <h6>Upload a different photo...</h6>
          
<<<<<<< HEAD
         <?= $this->Form->control('photo',['class'=>'form-control','type'=>'file','label'=>false])?>
=======
         <?= $this->form->control('photo',['class'=>'form-control','type'=>'file','label'=>false])?>
>>>>>>> f5a9c8a534d2855ca2beb668a0a78795d0d07b37
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <!--<div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
          This is an <strong>.alert</strong>. Use this to show important messages to the user.
        </div>-->
        <h3>Personal info</h3>
        
        
          <div class="form-group">
            <label class="col-lg-3 control-label">Name:</label>
            <div class="col-lg-8">
<<<<<<< HEAD
              <?= $this->Form->control('name',['class'=>'form-control','value'=>$user->name,'label'=>false])?>
=======
              <?= $this->form->control('name',['class'=>'form-control','value'=>$user->name,'label'=>false])?>
>>>>>>> f5a9c8a534d2855ca2beb668a0a78795d0d07b37
            </div>
          </div>
		  <div class="form-group">
            <label class="col-lg-3 control-label">Date of Birth:</label>
            <div class="col-lg-8">
<<<<<<< HEAD
              <?= $this->Form->control('dob',['class'=>'form-control','value'=>$user->dob,'label'=>false,'id'=>'datepicker','type'=>'text'])?>
=======
              <?= $this->form->control('dob',['class'=>'form-control','value'=>$user->dob,'label'=>false,'id'=>'datepicker'])?>
>>>>>>> f5a9c8a534d2855ca2beb668a0a78795d0d07b37
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
<<<<<<< HEAD
              <?= $this->Form->control('email',['class'=>'form-control','value'=>$user->email,'label'=>false])?>
=======
              <?= $this->form->control('email',['class'=>'form-control','value'=>$user->email,'label'=>false])?>
>>>>>>> f5a9c8a534d2855ca2beb668a0a78795d0d07b37
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Mobile No:</label>
            <div class="col-lg-8">
<<<<<<< HEAD
              <?= $this->Form->control('mobile',['class'=>'form-control','value'=>$user->mobile,'label'=>false])?>
=======
              <?= $this->form->control('mobile',['class'=>'form-control','value'=>$user->mobile,'label'=>false])?>
>>>>>>> f5a9c8a534d2855ca2beb668a0a78795d0d07b37
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Password:</label>
            <div class="col-md-8">
<<<<<<< HEAD
             <?= $this->Form->control('password',['class'=>'form-control','value'=>'','label'=>false,'required'=>true])?>
=======
             <?= $this->form->control('password',['class'=>'form-control','value'=>'','label'=>false,'required'=>true])?>
>>>>>>> f5a9c8a534d2855ca2beb668a0a78795d0d07b37
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm password:</label>
            <div class="col-md-8">
<<<<<<< HEAD
              <?= $this->Form->control('confirm_password',['class'=>'form-control','value'=>'','label'=>false,'required'=>true,'type'=>'password'])?>
=======
              <?= $this->form->control('confirm_password',['class'=>'form-control','value'=>'','label'=>false,'required'=>true])?>
>>>>>>> f5a9c8a534d2855ca2beb668a0a78795d0d07b37
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <?= $this->Form->button(' Save Changes', ['escape' => false, 'class' => 'btn btn-primary']); ?>
              <span></span>
              
            </div>
          </div>
        
      </div>
  </div>
 <?= $this->Form->end(); ?>
</div>
<hr>
<?= $this->Html->scriptBlock("
$('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
$('.border-left-0').hide();
", ['block' => true]);
  ?>