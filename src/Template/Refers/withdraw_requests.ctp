<div class="row py-3">
  <div class="col-md-12">
	<table class="table">
	  <thead>
		<tr>
		  <th>User</th>
		  <th>Points</th>
		  <th>Date</th>
		  <th>Action</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($requests as $request): ?>
		<tr>
			<td><?= $request->user->name ?></td>
			<td><?= $request->points ?></td>
			<td><?= $request->created_on->format("d-M-Y h:i A") ?></td>
			<td>
			<?php  echo $this->Html->link(__('Money sent'), ['controller' => 'Refers', 'action' => 'moneySent', $request->id]); ?>
			<?php  echo $this->Html->link(__('Reject request'), ['controller' => 'Refers', 'action' => 'CancelRequest', $request->id]); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	  </tbody>
	</table>
  </div>
</div>

