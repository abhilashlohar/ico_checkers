<div class="row py-3">
  <div class="col-md-12">
	<table class="table">
	  <thead>
		<tr>
		  <th>News title</th>
		  <th>Action</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($news as $news): ?>
		<tr>
		  <td>
		  	<?= $this->Html->link(__($news->title), ['controller' => 'news', 'action' => 'view', $news->id]) ?>
		  	<p>
		  		<?php if($news->published_on){ ?>
		  		<span>Published on: </span>
		  		<span>
		  			<?= $news->published_on->format('d-m-Y h:i A') ?>
		  		</span>
		  		<?php } ?>

		  		<?php if(!$news->published_on){ ?>
		  		<span>Created on: </span>
		  		<span>
		  			<?= $news->created_on->format('d-m-Y h:i A') ?>
		  		</span>
		  		<?php } ?>
		  	</p>
		  </td>
		  <td>
			<?php echo $this->Html->link(__(' Edit'), ['controller' => 'news', 'action' => 'edit', $news->id]); ?>
			<?php if($news->is_approved=="no"){ 
				if($user_role=="Admin"){
					echo $this->Form->postLink(
						__('Approve'),
						['controller' => 'news', 'action' => 'approve', $news->id],
						['confirm' => __('Are you sure you want to approve?')]
					);
				}else if($user_role=="Staff"){
					echo '<span>Pending for approval</span>';				
				}
			}else{
				echo '<span>Approved</span>';	
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

