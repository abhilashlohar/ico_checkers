<div class="row py-3">
  <div class="col-md-12">
    <table class="table">
      <thead>
        <tr>
          <th>Task title</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tasks as $task): ?>
        <tr>
          <td>
            <?= $this->Html->link(__($task->title), ['controller' => 'tasks', 'action' => 'view', $task->id]) ?>
            <p>
                <span>Created on: </span>
                <span>
                   <?= $this->Time->format($task->created_on, 'd-m-Y h:i A') ?> <?php  //$task->created_on->format('d-m-Y h:i A') ?>
                </span>
            </p>
          </td>
          <td>
			<?php echo $this->Html->link(__(' Edit'), ['controller' => 'Tasks', 'action' => 'edit', $task->id]); ?></br>
			<?php echo $this->Html->link(__(' Proof Approval'), ['controller' => 'Tasks', 'action' => 'proofApproval', $task->id]); ?>
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