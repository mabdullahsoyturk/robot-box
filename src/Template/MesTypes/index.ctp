<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesType[]|\Cake\Collection\CollectionInterface $mesTypes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Message Type'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mesTypes index large-9 medium-8 columns content">
    <h3><?= __('Message Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= __('Is Public') ?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('x_par') ?></th>
            <th scope="col"><?= $this->Paginator->sort('y_par') ?></th>
            <th scope="col"><?= $this->Paginator->sort('t_par') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($mesTypes as $mesType): ?>
            <tr>
                <td><?= $this->Number->format($mesType->id) ?></td>
                <td><?= $mesType->belongsToUser ? __('No') : __('Yes') ?></td>
                <td><?= h($mesType->name) ?></td>
                <td><?= h($mesType->x_par) ?></td>
                <td><?= h($mesType->y_par) ?></td>
                <td><?= h($mesType->t_par) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mesType->id]) ?>
                    <?php if ($mesType->belongsToUser): ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mesType->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mesType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mesType->id)]) ?>
                    <?php endif; ?>
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
