<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Robot[]|\Cake\Collection\CollectionInterface $robots
 */
?>

<div class="container-fluid h-100">
    <div class="row h-100">
        <aside class="col-12 col-md-2 p-0 bg-dark sidebar">
            <nav class="navbar navbar-expand navbar-dark bg-dark flex-md-column flex-row align-items-start sidebar">
                <div class="collapse navbar-collapse">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                        <li class="nav-item">
                          <?php echo $this->Html->link(__('Quick Add'), ['action' => 'quick'], ['class' => 'nav-link custom-link pl-0']) ?>
                        </li>
                        <li class="nav-item">
                          <?php echo $this->Html->link(__('New Robot'), ['action' => 'add'], ['class' => 'nav-link custom-link pl-0']) ?>
                        </li>
                    </ul>
                </div>
            </nav>
        </aside>
        <main class="col">
            <div class="container" style="margin-top:20px;">
              <h3><?= __('Robots') ?></h3>
              <table class="table table-striped">
                  <thead class="thead-dark">
                  <tr>
                      <th scope="col"><a href="#"><?= __('Is Public') ?></a></th>
                      <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                      <th scope="col"><?= $this->Paginator->sort('ip_address') ?></th>
                      <th scope="col"><?= $this->Paginator->sort('port') ?></th>
                      <th scope="col"><?= $this->Paginator->sort('topic_id') ?></th>
                      <th scope="col"><a href="#"><?= __('Actions') ?></a></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($robots as $robot): ?>
                      <tr>
                          <td><?= $robot->is_public_robot ? "Yes" : "No" ?></td>
                          <td><?= h($robot->name) ?></td>
                          <td><?= $robot->is_public_robot ? "--" : h($robot->ip_address) ?></td>
                          <td><?= $robot->is_public_robot ? "--" : h($robot->ip_address) ?></td>
                          <td><?= $robot->has('topic') ? $this->Html->link($robot->topic->name, ['controller' => 'Topics', 'action' => 'view', $robot->topic->id]) : '' ?></td>
                          <td class="actions">
                              <?= $robot->is_public_robot ?
                                  $this->Html->link(__('Connect'),'#',
                                      ['onclick' => ('connectWithIp(' . $robot->id . ')')])
                                  : $this->Html->link(__('Connect'), ['action' => 'connect', $robot->id]) ?>
                              <?= $this->Html->link(__('View'), ['action' => 'view', $robot->id]) ?>
                              <?php if ($robot->belongsToUser): ?>
                                  <?= $this->Html->link(__('Edit'), ['action' => 'edit', $robot->id]) ?>
                                  <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $robot->id], ['confirm' => __('Are you sure you want to delete # {0}?', $robot->id)]) ?>
                              <?php endif; ?>
                          </td>
                      </tr>
                  <?php endforeach; ?>
                  </tbody>
              </table>
              
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
          </div>
        </main>
    </div>
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
