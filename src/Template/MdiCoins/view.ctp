<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MdiCoin $mdiCoin
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Mdi Coin'), ['action' => 'edit', $mdiCoin->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Mdi Coin'), ['action' => 'delete', $mdiCoin->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mdiCoin->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Mdi Coins'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mdi Coin'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mdiCoins view large-9 medium-8 columns content">
    <h3><?= h($mdiCoin->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $mdiCoin->has('user') ? $this->Html->link($mdiCoin->user->name, ['controller' => 'Users', 'action' => 'view', $mdiCoin->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Module') ?></th>
            <td><?= h($mdiCoin->module) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Task') ?></th>
            <td><?= $mdiCoin->has('task') ? $this->Html->link($mdiCoin->task->title, ['controller' => 'Tasks', 'action' => 'view', $mdiCoin->task->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mdiCoin->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Conis') ?></th>
            <td><?= $this->Number->format($mdiCoin->conis) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Referred User') ?></th>
            <td><?= $this->Number->format($mdiCoin->referred_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Created') ?></th>
            <td><?= h($mdiCoin->date_created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Modified') ?></th>
            <td><?= h($mdiCoin->date_modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Meta Description') ?></h4>
        <?= $this->Text->autoParagraph(h($mdiCoin->meta_description)); ?>
    </div>
</div>
