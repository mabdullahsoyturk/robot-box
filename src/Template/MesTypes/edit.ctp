<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesType $mesType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mesType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mesType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Message Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="mesTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($mesType) ?>
    <fieldset>
        <legend><?= __('Edit Mes Type') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('x_par');
            echo $this->Form->control('y_par');
            echo $this->Form->control('t_par');
            echo isset($admin) && $admin ? $this->Form->control("is_public_message_type") : "";
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
