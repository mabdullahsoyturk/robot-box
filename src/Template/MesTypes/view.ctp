<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesType $mesType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <?php if (isset($belongsToUser) && $belongsToUser): ?>
            <li><?= $this->Html->link(__('Edit Message Type'), ['action' => 'edit', $mesType->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Message Type'), ['action' => 'delete', $mesType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mesType->id)]) ?> </li>
        <?php endif; ?>
    </ul>
</nav>
<div class="mesTypes view large-9 medium-8 columns content">
    <h3><?= h($mesType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($mesType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('X Par') ?></th>
            <td><?= h($mesType->x_par) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Y Par') ?></th>
            <td><?= h($mesType->y_par) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('T Par') ?></th>
            <td><?= h($mesType->t_par) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Public') ?></th>
            <td><?= $mesType->is_public_message_type ? "Yes" : "No"?></td>
        </tr>
    </table>
</div>
