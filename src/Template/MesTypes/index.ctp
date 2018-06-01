<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesType[]|\Cake\Collection\CollectionInterface $mesTypes
 */
?>

<div class="container" style="margin-top:30px;">
    <h1><?= __('My Message Types') ?></h1>
    <hr align="left" >
    <?php echo $this->Html->link(__('Create New Message Type'), ['action' => 'add'], ['class' => 'btn btn-md btn-action btn-add']) ?>
    <table class="table table-striped" style="table-layout: fixed; word-wrap: break-word;">
        <thead class="thead-dark">
            <tr>
                <th style="width: 17%"><?= $this->Paginator->sort('name') ?></th>
                <th style="width: 17%"><?= $this->Paginator->sort('x_par') ?></th>
                <th style="width: 17%"><?= $this->Paginator->sort('y_par') ?></th>
                <th style="width: 17%"><?= $this->Paginator->sort('t_par') ?></th>
                <th style="width: 10%"><a href="#"><?= __('Is Public') ?></a></th>
                <th style="width: 20%"><a href="#"><?= __('Actions') ?></a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mesTypes as $mesType): ?>
                <tr>
                    <td class="align-middle"><?= h($mesType->name) ?></td>
                    <td class="align-middle"><?= h($mesType->x_par) ?></td>
                    <td class="align-middle"><?= h($mesType->y_par) ?></td>
                    <td class="align-middle"><?= h($mesType->t_par) ?></td>
                    <td class="align-middle"><?= $mesType->is_public_message_type ? __('Yes') : __('No') ?></td>
                    <td class="actions align-middle">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $mesType->id], ['class' => 'btn btn-info btn-sm']) ?>
                        <?php if ($mesType->belongsToUser): ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mesType->id], ['class' => 'btn btn-warning btn-sm']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mesType->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete # {0}?', $mesType->id)]) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
