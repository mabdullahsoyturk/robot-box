<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Topic[]|\Cake\Collection\CollectionInterface $topics
 */
?>



<div class="container" style="margin-top:30px;">

  <h1><?= __('My Topics') ?></h1>
  <hr align="left" >
  <?php echo $this->Html->link(__('Create New Topic'), ['action' => 'add'], ['class' => 'btn btn-md btn-action btn-add']) ?>

  <table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('mes_id') ?></th>
            <th scope="col"><a href="#"><?= __('Is Public') ?></a></th>
            <th scope="col" class="actions"><a href="#"><?= __('Actions') ?></a></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($topics as $topic): ?>
            <tr>
                <td><?= h($topic->name) ?></td>
                <td><?= $topic->has('mes_type') ? $this->Html->link($topic->mes_type->name, ['controller' => 'MesTypes', 'action' => 'view', $topic->mes_type->id]) : '' ?></td>
                <td><?= $topic->is_public_topic ? __('Yes') : __('No')?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $topic->id], ['class' => 'btn btn-info btn-sm']) ?>
                    <?php if ($topic->belongsToUser): ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $topic->id], ['class' => 'btn btn-warning btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $topic->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete # {0}?', $topic->id)]) ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
