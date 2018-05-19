<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Robot $robot
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <?php if ($robot->belongsToUser): ?>
            <li><?= $this->Html->link(__('Edit Robot'), ['action' => 'edit', $robot->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Robot'), ['action' => 'delete', $robot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $robot->id)]) ?> </li>
        <?php endif; ?>
    </ul>
</nav>
<div class="robots view large-9 medium-8 columns content">
    <h3><?= h($robot->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($robot->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ip Address') ?></th>
            <td><?= $robot->is_public_robot ? "Public Robot" : h($robot->ip_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Port') ?></th>
            <td><?= $robot->is_public_robot ? "Public Robot" : h($robot->port) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Topic') ?></th>
            <td><?= $robot->has('topic') ? $this->Html->link($robot->topic->name, ['controller' => 'Topics', 'action' => 'view', $robot->topic->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Public') ?></th>
            <td><?=$robot->is_public_robot ? "Yes" : "No" ?></td>
        </tr>
    </table>
</div>
