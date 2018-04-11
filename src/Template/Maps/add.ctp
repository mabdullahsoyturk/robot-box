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
        echo $this->Form->control('width', ['step' => 'any']);
        echo $this->Form->control('height', ['step' => 'any']);
        ?>

        <fieldset>
            <legend>Map Orientation</legend>
            <label style="display: inline">1<?= $this->Html->image("space_0.png", ['width' => '200']) ?></label>
            <label style="display: inline">2<?= $this->Html->image("space_1.png", ['width' => '200']) ?></label>
            <label style="display: inline">3<?= $this->Html->image("space_2.png", ['width' => '200']) ?></label>
            <label style="display: inline">4<?= $this->Html->image("space_3.png", ['width' => '200']) ?></label>
            <?php echo $this->Form->select(
                'space',
                [1, 2, 3, 4]
            ); ?>

        </fieldset>

        <?php
        echo $this->Form->control('x_zero', ['step' => 'any']);
        echo $this->Form->control('y_zero', ['step' => 'any']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Add')) ?>
    <?= $this->Form->end() ?>
</div>
