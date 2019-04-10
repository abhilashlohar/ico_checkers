<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Refer[]|\Cake\Collection\CollectionInterface $refers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Refer'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="refers index large-9 medium-8 columns content">
    <h3><?= __('Refers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ref_by_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ref_to_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('points') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($refers as $refer): ?>
            <tr>
                <td><?= $this->Number->format($refer->id) ?></td>
                <td><?= $this->Number->format($refer->ref_by_user_id) ?></td>
                <td><?= $this->Number->format($refer->ref_to_user_id) ?></td>
                <td><?= h($refer->created_date) ?></td>
                <td><?= $this->Number->format($refer->points) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $refer->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $refer->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $refer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $refer->id)]) ?>
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
