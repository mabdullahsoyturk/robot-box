<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Robot[]|\Cake\Collection\CollectionInterface $robots
 */
?>

<div class="container" style="margin-top:30px;">

  <h1><?= __('My Robots') ?></h1>
  <hr align="left" >

  <?php echo $this->Html->link(__('Create New Robot'), ['action' => 'add'], ['class' => 'btn btn-md btn-action btn-add']) ?>

  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
        <th scope="col"><?= $this->Paginator->sort('ip_address') ?></th>
        <th scope="col"><?= $this->Paginator->sort('port') ?></th>
        <th scope="col"><?= $this->Paginator->sort('topic_id') ?></th>
        <th scope="col"><a href="#"><?= __('Is Public') ?></a></th>
        <th scope="col"><a href="#"><?= __('Actions') ?></a></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($robots as $robot): ?>
        <tr>
          <td><?= h($robot->name) ?></td>
          <td><?= $robot->is_public_robot ? "--" : h($robot->ip_address) ?></td>
          <td><?= $robot->is_public_robot ? "--" : h($robot->ip_address) ?></td>
          <td><?= $robot->has('topic') ? $this->Html->link($robot->topic->name, ['controller' => 'Topics', 'action' => 'view', $robot->topic->id]) : '' ?></td>
          <td><?= $robot->is_public_robot ? "Yes" : "No" ?></td>
          <td class="actions">
            <?= $robot->is_public_robot ?
            $this->Html->link(__('Connect'),'#',
              ['onclick' => ('connectWithIp(' . $robot->id . ')')])
              : $this->Html->link(__('Connect'), ['action' => 'connect', $robot->id], ['class' => 'btn btn-success btn-md']) ?>
              <?= $this->Html->link(__('View'), ['action' => 'view', $robot->id], ['class' => 'btn btn-info btn-sm']) ?>
              <?php if ($robot->belongsToUser): ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $robot->id], ['class' => 'btn btn-warning btn-sm']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $robot->id], [ 'class' => 'btn btn-danger btn-sm', 'confirm' => __('Are you sure you want to delete # {0}?', $robot->id)]) ?>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php $this->append('script') ?>
  <script type="text/javascript">
    function connectWithIp(r){
      let ip =prompt("Please enter Ip","");
      let port = prompt("Please enter websocket port", "");
      window.open("<?= $this->Url->build(['action' => 'connect'])  ?>" + "/" + r + "?ip=" + ip + "&port=" + port,"_self")
    }
  </script>


  <?php $this->end(); ?>
