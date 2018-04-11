<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Map[]|\Cake\Collection\CollectionInterface $maps
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Map'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="maps index large-9 medium-8 columns content">
    <h3><?= __('Maps') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('width') ?></th>
                <th scope="col"><?= $this->Paginator->sort('height') ?></th>
                <th scope="col"><?= $this->Paginator->sort('space') ?></th>
                <th scope="col"><?= $this->Paginator->sort('x_zero') ?></th>
                <th scope="col"><?= $this->Paginator->sort('y_zero') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($maps as $map): ?>
            <tr>
                <td><?= $this->Number->format($map->id) ?></td>
                <td><?= $map->has('user') ? $this->Html->link($map->user->id, ['controller' => 'Users', 'action' => 'view', $map->user->id]) : '' ?></td>
                <td><?= $this->Number->format($map->width) ?></td>
                <td><?= $this->Number->format($map->height) ?></td>
                <td><?= $this->Number->format($map->space) ?></td>
                <td><?= $this->Number->format($map->x_zero) ?></td>
                <td><?= $this->Number->format($map->y_zero) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $map->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $map->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $map->id], ['confirm' => __('Are you sure you want to delete # {0}?', $map->id)]) ?>
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
