<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Topic[]|\Cake\Collection\CollectionInterface $topics
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Topic'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="topics index large-9 medium-8 columns content">
    <h3><?= __('Topics') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mes_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('max_x') ?></th>
                <th scope="col"><?= $this->Paginator->sort('min_x') ?></th>
                <th scope="col"><?= $this->Paginator->sort('max_y') ?></th>
                <th scope="col"><?= $this->Paginator->sort('min_y') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($topics as $topic): ?>
            <tr>
                <td><?= $this->Number->format($topic->id) ?></td>
                <td><?= $topic->has('user') ? $this->Html->link($topic->user->id, ['controller' => 'Users', 'action' => 'view', $topic->user->id]) : '' ?></td>
                <td><?= h($topic->name) ?></td>
                <td><?= $topic->has('mes_type') ? $this->Html->link($topic->mes_type->name, ['controller' => 'MesTypes', 'action' => 'view', $topic->mes_type->id]) : '' ?></td>
                <td><?= $this->Number->format($topic->max_x) ?></td>
                <td><?= $this->Number->format($topic->min_x) ?></td>
                <td><?= $this->Number->format($topic->max_y) ?></td>
                <td><?= $this->Number->format($topic->min_y) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $topic->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $topic->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $topic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $topic->id)]) ?>
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
