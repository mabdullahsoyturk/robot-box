<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Topic $topic
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Topics'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Add a New Message Type'), ['action' => 'add', 'controller' => 'MesTypes']) ?></li>
    </ul>
</nav>
<div class="topics form large-9 medium-8 columns content">
    <?= $this->Form->create($topic) ?>
    <fieldset>
        <legend><?= __('Add Topic') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('name');
            echo $this->Form->control('mes_id', ['options' => $mesTypes]);
            echo $this->Form->control('max_x');
            echo $this->Form->control('min_x');
            echo $this->Form->control('max_y');
            echo $this->Form->control('min_y');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
