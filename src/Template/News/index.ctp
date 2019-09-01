<div class="card my-3">
  <div class="card-body">
    <div class="row">
		  <div class="col-md-12">
		  	
				<table class="table table-striped table-hover table-sm border">
			  	<thead class="thead-light">
						<tr>
						  <th>Title</th>
						  <?php if ($user_role=="Admin") echo '<th>Submitted by</th>'; ?>
						  <th>Status</th>
						  <th>Action</th>
						</tr>
			  	</thead>
			  	<tbody>
					<?php foreach ($news as $news): ?>
						<tr>
					  	<td><?= $news->title ?></td>
					  	<?php if ($user_role=="Admin") echo '<td>'. $news->user->name. '</td>'; ?>
					  	<td><?= $news->status ?></td>
					  	<td>
					  		<?php 
					  		if ( ($user_role=='User' and $news->status=="Pending for approval") or ($user_role=='Admin') ) {
									echo $this->Html->link(__(' Edit'), ['controller' => 'news', 'action' => 'edit', $news->id]);
					  		} 
								
								echo $this->Html->link(__(' View'), ['controller' => 'news', 'action' => 'view', $news->id]);
					  		?>
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
  </div>
</div>



