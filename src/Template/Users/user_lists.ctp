<div class="row py-3">
  <div class="col-md-12">
  <div id="requestform_error"></div>
  
<<<<<<< HEAD
  
<input type="hidden" name="id" id="msg_id"  value="<?= @$id ?>">
=======
  <?= $this->form->input('id',['type'=>'hidden','value'=>@$id,'id'=>'msg_id']) ?> 
>>>>>>> f5a9c8a534d2855ca2beb668a0a78795d0d07b37
	<table class="table">
	  <thead>
		<tr>
		  <th></th>
		  <th></th>
		  <th>Name</th>
		  <th>Email</th>
		  <th>Mobile</th>
		  <th>Role</th>
		  
		</tr>
	  </thead>
	  <tbody>
		<?php $i=0;foreach($users as $user): ?>
		<tr>
		   
		  <th>
<<<<<<< HEAD
		  <?php //echo  $this->html->input('',['type'=>'checkbox','value'=>@$user->id,'class'=>'user_id']); ?>
		 <input type="checkbox" name="chk" class="user_id"  value="<?= @$user->id ?>">
=======
		  <?php echo  $this->Form->input('',['type'=>'checkbox','value'=>@$user->id,'class'=>'user_id']); ?>
>>>>>>> f5a9c8a534d2855ca2beb668a0a78795d0d07b37
		  </th>
		  
		  <td><?= ++$i ?></td>
		  <td>
		  	<?= $user->name ?>
		  </td>
		  <td>
		  	<?= $user->email ?>
		  </td>
		  <td>
		  	<?= $user->mobile ?>
		  </td>
		  <td>
		  	<?= $user->role ?>
		  </td>
		  
		</tr>
		<?php endforeach; ?>
	  </tbody>
	</table>
	<div class="paginator">
		<ul class="pagination">
			<?= $this->Paginator->first('<< ' . __('first')) ?>
			<?= $this->Paginator->prev('< ' . __('previous')) ?>
			<?= $this->Paginator->numbers() ?>
			<?= $this->Paginator->next(__('next') . ' >') ?>
			<?= $this->Paginator->last(__('last') . ' >>') ?>
		</ul>
		<p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
	</div>
	 <button type="button" class="btn btn-primary sent">sent</button>
	 <span style="padding-left: 12%;color:white;background:pink;display:none;" class="requestform_error1" ></span>
        
  </div>
</div>
<?php echo $this->fetch('postLink'); ?>
<?=
$this->Html->scriptBlock(" 
var id = ".@$id.";
$(document).on('click', '.user_id', function(){ 
   if($(this).is(':checked'))
   {
	    var chk = 1;
   }
   else{
		var chk = 0;
   }	
	$.ajax({
        method: 'GET',
        url: '".$this->Url->build(['controller' => 'Users','action' => 'saveemailuser'])."',
        dataType: 'html',
        data:{
				user_id:$(this).val(),
				id:id,
				chk:chk
            },
        cache: false,
        beforeSend: function() { 
            //$('#ajax-indicator').fadeIn();
			
        }
    }).done(function(data) { 
       
        $('.requestform_error').html(data);
        //$('.requestform_error').fadeIn('fast').delay(5000).fadeOut('fast'); 
    }).always(function() {
        //$('#ajax-indicator').fadeOut();
    });
    
    //return false;
   
});

<<<<<<< HEAD
$(document).on('click', '.sent', function(){  
=======
$(document).on('click', '.sent', function(){ 
>>>>>>> f5a9c8a534d2855ca2beb668a0a78795d0d07b37
	$.ajax({
        method: 'GET',
        url: '".$this->Url->build(['controller' => 'Users','action' => 'saveMsgStatus'])."',
        dataType: 'html',
        data:{
				id:$('#msg_id').val()
			 },
        cache: false,
        beforeSend: function() { 
            //$('#ajax-indicator').fadeIn();
			
        }
    }).done(function(data) { 
       if(data==1){
        $('.requestform_error1').html('Email Sent successfully.');
		$('.requestform_error1').show();
        $('.requestform_error1').fadeIn('fast').delay(5000).fadeOut('fast'); 
<<<<<<< HEAD
		window.location.href ='/users'
=======
		window.location.href ='/ico_checkers/users'
>>>>>>> f5a9c8a534d2855ca2beb668a0a78795d0d07b37
	   }
	   else{
		$('.requestform_error1').html('Try Again.');
		$('.requestform_error1').show();
        $('.requestform_error1').fadeIn('fast').delay(8000).fadeOut('fast');  
	   }
    }).always(function() {
        //$('#ajax-indicator').fadeOut();
    });
   
}); 
", ['block' => true]); ?>
