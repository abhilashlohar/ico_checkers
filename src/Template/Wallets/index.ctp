<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Wallet[]|\Cake\Collection\CollectionInterface $wallets
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Wallet'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List News'), ['controller' => 'News', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New News'), ['controller' => 'News', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="wallets index large-9 medium-8 columns content">
    <h3><?= __('Wallets') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('point') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reason') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('news_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('task_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($wallets as $wallet): ?>
            <tr>
                <td><?= $this->Number->format($wallet->id) ?></td>
                <td><?= $wallet->has('user') ? $this->Html->link($wallet->user->name, ['controller' => 'Users', 'action' => 'view', $wallet->user->id]) : '' ?></td>
                <td><?= $this->Number->format($wallet->point) ?></td>
                <td><?= h($wallet->reason) ?></td>
                <td><?= h($wallet->transaction_date) ?></td>
                <td><?= $wallet->has('news') ? $this->Html->link($wallet->news->title, ['controller' => 'News', 'action' => 'view', $wallet->news->id]) : '' ?></td>
                <td><?= $wallet->has('task') ? $this->Html->link($wallet->task->title, ['controller' => 'Tasks', 'action' => 'view', $wallet->task->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $wallet->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $wallet->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $wallet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wallet->id)]) ?>
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
