<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesType $mesType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Message Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="mesTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($mesType) ?>
    <fieldset>
        <legend><?= __("Sample Message Type") ?></legend>
        <?= $this->Html->image("sample_message_type.png") ?>
        <p>
            Name : turtlesim/Pose<br>
            X Parameter : x<br>
            Y Parameter : y<br>
            Theta Parameter : theta
        </p>
    </fieldset>
    <fieldset>
        <legend><?= __('Add Message Type') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('x_par', ['label' => 'X Parameter']);
            echo $this->Form->control('y_par', ['label' => 'Y Parameter']);
            echo $this->Form->control('t_par', ['label' => 'Theta(Angle) Parameter']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Add')) ?>
    <?= $this->Form->end() ?>
</div>
