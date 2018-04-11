<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Robot $robot
 */
?>

<div class="robots form large-12 medium-8 columns content">
    <?= $this->Form->create($robot) ?>
    <fieldset>
        <legend><?= __('Edit Robot') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('ip_address');
            echo $this->Form->control('port');
            echo $this->Form->control('topic_id', ['options' => $topics]);
            echo $this->Form->control('map_id', ['options' => $maps]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
