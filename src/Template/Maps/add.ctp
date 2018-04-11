<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Map $map
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Maps'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="maps form large-9 medium-8 columns content">
    <?= $this->Form->create($map) ?>
    <fieldset>
        <legend><?= __('Add Map') ?></legend>
        <?php
            echo $this->Form->control('width');
            echo $this->Form->control('height');
            echo $this->Form->control('space');
            echo $this->Form->control('x_zero');
            echo $this->Form->control('y_zero');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Add')) ?>
    <?= $this->Form->end() ?>
</div>
