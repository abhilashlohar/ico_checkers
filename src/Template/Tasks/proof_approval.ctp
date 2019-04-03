<div class="row py-3">
  <div class="col-md-12">
	<table class="table">
	  <thead>
		<tr>
		  <th>Image</th>
		  <th>Message</th>
		  <th>Task</th>
		  <th>User</th>
		  <th>Status</th>
		  <th>Action</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($task_proofs as $task_proof): ?>
		<tr>
		  <td>
			<?= $this->Html->Image(str_replace("\\","/",$task_proof->image),['height'=>90,'width'=>90])?>
		  </td>
		  <td>
		  	<?= $task_proof->message ?>
		  </td>
		  <td>
		  	<?= $task_proof->task->title ?>
		  </td>
		  <td>
		  	<?= $task_proof->user->name ?>
		  </td>
		  <td>
		  	<?php if($task_proof->is_approved==1){ echo 'Approved'; }else{ echo 'Pending';} ?>
		  </td>
		  <td>
			<?php if($task_proof->is_approved!=1){
			echo $this->Form->postLink(
					__('Approve'),
					['controller' => 'Tasks', 'action' => 'approve', $task_proof->id],
					['confirm' => __('Are you sure you want to approve?')]
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

