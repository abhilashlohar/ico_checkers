<div class="row py-3">
  <div class="col-md-12">
	<table class="table">
	  <thead>
		<tr>
		  <th></th>
		  <th>Name</th>
		  <th>Email</th>
		  <th>Mobile</th>
		  <th>Role</th>
		  <th>Status</th>
		  <th>Action</th>
		</tr>
	  </thead>
	  <tbody>
		<?php $i=0;foreach($users as $user): ?>
		<tr>
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

