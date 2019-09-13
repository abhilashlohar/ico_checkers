<div class="card my-3">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        
        <table class="table table-striped table-hover table-sm border">
          <thead class="thead-light">
            <tr>
              <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
              <th scope="col"><?= $this->Paginator->sort('coins') ?></th>
              <th scope="col"><?= $this->Paginator->sort('date_created','Time') ?></th>
              <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($mdiCoins as $mdiCoin): ?>
            <tr>
              <td><?= $mdiCoin->has('user') ? $this->Html->link($mdiCoin->user->name, ['controller' => 'Users', 'action' => 'view', $mdiCoin->user->id],['target'=>'_blank']) : '' ?></td>
              <td><?= $this->Number->format($mdiCoin->coins) ?></td>
              <td><?= h($mdiCoin->date_created->format('d M,Y h:i A')) ?></td>
              <td class="actions">
                  <?= $this->Form->postLink(__('Money Sent'), ['action' => 'approve', $mdiCoin->id], ['confirm' => __('Are you sure you have sent money to the user?')]) ?>
                  <?= $this->Form->postLink(__('Reject'), ['action' => 'reject', $mdiCoin->id], ['confirm' => __('Are you sure you want to reject the request?')]) ?>
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