<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Robot[]|\Cake\Collection\CollectionInterface $robots
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Robot'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="robots index large-9 medium-8 columns content">
    <h3><?= __('Robots') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ip_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('port') ?></th>
                <th scope="col"><?= $this->Paginator->sort('topic_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('map_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($robots as $robot): ?>
            <tr>
                <td><?= $this->Number->format($robot->id) ?></td>
                <td><?= $robot->has('user') ? $this->Html->link($robot->user->id, ['controller' => 'Users', 'action' => 'view', $robot->user->id]) : '' ?></td>
                <td><?= h($robot->ip_address) ?></td>
                <td><?= h($robot->port) ?></td>
                <td><?= $robot->has('topic') ? $this->Html->link($robot->topic->name, ['controller' => 'Topics', 'action' => 'view', $robot->topic->id]) : '' ?></td>
                <td><?= $robot->has('map') ? $this->Html->link($robot->map->id, ['controller' => 'Maps', 'action' => 'view', $robot->map->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $robot->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $robot->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $robot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $robot->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
