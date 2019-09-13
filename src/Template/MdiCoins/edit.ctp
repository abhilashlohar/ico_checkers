<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MdiCoin $mdiCoin
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mdiCoin->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mdiCoin->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Mdi Coins'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mdiCoins form large-9 medium-8 columns content">
    <?= $this->Form->create($mdiCoin) ?>
    <fieldset>
        <legend><?= __('Edit Mdi Coin') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('conis');
            echo $this->Form->control('module');
            echo $this->Form->control('task_id', ['options' => $tasks, 'empty' => true]);
            echo $this->Form->control('referred_user');
            echo $this->Form->control('meta_description');
            echo $this->Form->control('date_created');
            echo $this->Form->control('date_modified');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
