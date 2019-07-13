<div class="row py-3">
  <div class="col-md-12">
    <table class="table">
      <thead>
        <tr>
          <th>Task title</th>
          <th>Created on</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tasks as $task): ?>
        <tr>
          <td>
            <?= $task->title ?>
          </td>
          <td><?= $task->created_on->format("d-m-Y h:i A") ?> </td>
          <td>
    			<?php echo $this->Html->link(__(' Edit'), ['controller' => 'Tasks', 'action' => 'edit', $task->id,]); ?> | 
    			<?php echo $this->Html->link(__('Approve Proofs'), ['controller' => 'Tasks', 'action' => 'proofApproval', $task->id]); ?>
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