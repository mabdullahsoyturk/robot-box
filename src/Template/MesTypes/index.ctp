<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesType[]|\Cake\Collection\CollectionInterface $mesTypes
 */
?>
<div class="container-fluid h-100">
    <div class="row h-100">
        <aside class="col-12 col-md-2 p-0 bg-dark sidebar">
            <nav class="navbar navbar-expand navbar-dark bg-dark flex-md-column flex-row align-items-start sidebar">
                <div class="collapse navbar-collapse">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                        <li class="nav-item">
                          <?php echo $this->Html->link(__('New Message'), ['action' => 'add'], ['class' => 'nav-link custom-link pl-0']) ?>
                        </li>
                    </ul>
                </div>
            </nav>
        </aside>
        <main class="col">
            <div class="container" style="margin-top:20px;">
                <h3><?= __('Message Types') ?></h3>
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><a href="#"><?= __('Is Public') ?></a></th>
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('x_par') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('y_par') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('t_par') ?></th>
                        <th scope="col" class="actions"><a href="#"><?= __('Actions') ?></a></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($mesTypes as $mesType): ?>
                        <tr>
                            <td><?= $mesType->is_public_message_type ? __('Yes') : __('No') ?></td>
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
