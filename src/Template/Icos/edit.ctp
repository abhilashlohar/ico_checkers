<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ico $ico
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ico->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ico->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Icos'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="icos form large-9 medium-8 columns content">
    <?= $this->Form->create($ico) ?>
    <fieldset>
        <legend><?= __('Edit Ico') ?></legend>
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
