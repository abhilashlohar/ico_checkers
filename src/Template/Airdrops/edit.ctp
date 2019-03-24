<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Airdrop $airdrop
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $airdrop->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $airdrop->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Airdrops'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="airdrops form large-9 medium-8 columns content">
    <?= $this->Form->create($airdrop) ?>
    <fieldset>
        <legend><?= __('Edit Airdrop') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('link');
            echo $this->Form->control('country');
            echo $this->Form->control('email');
            echo $this->Form->control('applied_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
