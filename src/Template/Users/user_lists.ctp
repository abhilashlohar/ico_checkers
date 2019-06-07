<div class="row py-3">
  <div class="col-md-12">
  <div id="requestform_error"></div>
  
  
<input type="hidden" name="id" id="msg_id"  value="<?= @$id ?>">
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
		  <?php //echo  $this->html->input('',['type'=>'checkbox','value'=>@$user->id,'class'=>'user_id']); ?>
		 <input type="checkbox" name="chk" class="user_id"  value="<?= @$user->id ?>">
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

$(document).on('click', '.sent', function(){  
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
		window.location.href ='/users'
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
