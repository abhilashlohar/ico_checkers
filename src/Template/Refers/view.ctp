<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Refer $refer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Refer'), ['action' => 'edit', $refer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Refer'), ['action' => 'delete', $refer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $refer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Refers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Refer'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="refers view large-9 medium-8 columns content">
    <h3><?= h($refer->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($refer->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ref By User Id') ?></th>
            <td><?= $this->Number->format($refer->ref_by_user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ref To User Id') ?></th>
            <td><?= $this->Number->format($refer->ref_to_user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Points') ?></th>
            <td><?= $this->Number->format($refer->points) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created Date') ?></th>
            <td><?= h($refer->created_date) ?></td>
        </tr>
    </table>
</div>
