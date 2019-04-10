<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Refer $refer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $refer->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $refer->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Refers'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="refers form large-9 medium-8 columns content">
    <?= $this->Form->create($refer) ?>
    <fieldset>
        <legend><?= __('Edit Refer') ?></legend>
        <?php
            echo $this->Form->control('ref_by_user_id');
            echo $this->Form->control('ref_to_user_id');
            echo $this->Form->control('created_date');
            echo $this->Form->control('points');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
