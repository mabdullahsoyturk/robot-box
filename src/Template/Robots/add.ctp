<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Robot $robot
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Robots'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link("Add a new topic", ['controller'=>"topics", "action"=>"add"]) ?></li>
        <li><?= $this->Html->link("Add a new map", ['controller'=>"maps", "action"=>"add"]); ?></li>

    </ul>
</nav>

<div class="robots form large-9 medium-8 columns content">
    <?= $this->Form->create($robot) ?>
    <fieldset>
        <legend><?= __('Add Robot') ?></legend>
        <?php
        echo $this->Form->control('ip_address');
        echo $this->Form->control('port');
        echo $this->Form->control('topic_id', ['options' => $topics]);
        echo $this->Html->link("Add new topic", ['controller'=>"topics", "action"=>"add"]);
        echo $this->Form->control('map_id', ['options' => $maps]);
        echo $this->Html->link("Add new map", ['controller'=>"maps", "action"=>"add"]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

