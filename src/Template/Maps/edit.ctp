<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Map $map
 */
?>
<div class="maps form large-12 medium-8 columns content">
    <?= $this->Form->create($map) ?>
    <fieldset>
        <legend><?= __('Edit Map') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('width');
            echo $this->Form->control('height');
            echo $this->Form->control('space');
            echo $this->Form->control('x_zero');
            echo $this->Form->control('y_zero');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
