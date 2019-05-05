<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ico $ico
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ico'), ['action' => 'edit', $ico->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ico'), ['action' => 'delete', $ico->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ico->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Icos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ico'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="icos view large-9 medium-8 columns content">
    <h3><?= h($ico->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($ico->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Link') ?></th>
            <td><?= h($ico->link) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= h($ico->country) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($ico->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ico->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Applied On') ?></th>
            <td><?= h($ico->applied_on) ?></td>
        </tr>
    </table>
</div>
