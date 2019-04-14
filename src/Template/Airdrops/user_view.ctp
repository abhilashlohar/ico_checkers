<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Airdrop $airdrop
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Airdrop'), ['action' => 'edit', $airdrop->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Airdrop'), ['action' => 'delete', $airdrop->id], ['confirm' => __('Are you sure you want to delete # {0}?', $airdrop->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Airdrops'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Airdrop'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="airdrops view large-9 medium-8 columns content">
    <h3><?= h($airdrop->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($airdrop->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Link') ?></th>
            <td><?= h($airdrop->link) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= h($airdrop->country) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($airdrop->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($airdrop->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Applied On') ?></th>
            <td><?= h($airdrop->applied_on) ?></td>
        </tr>
    </table>
</div>
