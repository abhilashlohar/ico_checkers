<div class="row py-3">
  <div class="col-md-12">
  <div id="requestform_error"></div>
	<table class="table">
	  <thead>
		<tr>
		  <?php
		  if(!empty($id)){
		  ?>
		  <th></th>
		  <?php } ?>
		  <th></th>
		  <th>Name</th>
		  <th>Email</th>
		  <th>Mobile</th>
		  <th>Role</th>
		  <?php if(empty($id)){ ?>
		  <th>Status</th>
		  <th>Action</th>
		  <?php } ?>
		</tr>
	  </thead>
	  <tbody>
		<?php $i=0;foreach($users as $user): ?>
		<tr>
		   <?php if(!empty($id)){
		  ?>
		  <th>
		  <?php echo  $this->Form->input('',['type'=>'checkbox','value'=>@$user->id,'class'=>'user_id']); ?>
		  </th>
		  <?php } ?>
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
		  <?php if(empty($id)){ ?>
		   <td>
		  	<?php if($user->status==true){
				echo 'Active';
			}else{ echo 'Deactive'; }
			
		?>
		  </td>
		  <td>
			<?php if($user->status==true){
			echo $this->Form->postLink(
					__('Deactive'),
					['controller' => 'Users', 'action' => 'changeStatus', $user->id,'deactive'],
					['confirm' => __('Are you sure you want to deactive?')]
				);
			
			}else{
				echo $this->Form->postLink(
					__('Active'),
					['controller' => 'Users', 'action' => 'changeStatus', $user->id,'active'],
					['confirm' => __('Are you sure you want to active?')]
				);
			} ?>
		  </td>
		  <?php } ?>
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
", ['block' => true]); ?>
