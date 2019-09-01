<div class="card my-3">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <h3><?= __('Comments for approval') ?></h3>
        <table class="table table-striped table-hover table-sm border">
          <thead class="thead-light">
            <tr>
              <th scope="col"><?= $this->Paginator->sort('news_id') ?></th>
              <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
              <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($comments as $comment): ?>
              <tr>
                <td><?= $comment->has('news') ? $this->Html->link($comment->news->title, ['controller' => 'News', 'action' => 'view', $comment->news->id]) : '' ?></td>
                <td><?= $comment->has('user') ? $this->Html->link($comment->user->name, ['controller' => 'Users', 'action' => 'view', $comment->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Form->postLink(__('Approve'), ['action' => 'approve', $comment->id], ['confirm' => __('Are you sure you want to approve the comment?'),'class'=>'btn btn-primary btn-sm']) ?>
                    <?= $this->Form->postLink(__('Reject'), ['action' => 'reject', $comment->id], ['confirm' => __('Are you sure you want to reject the comment?'),'class'=>'btn btn-primary btn-sm']) ?>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <?= $comment->comment ?>
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