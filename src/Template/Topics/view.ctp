<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Topic $topic
 */
?>

<div class="container" style="margin-top:30px;">
    <div class="row justify-content-center">
        <div class="col-md-9"> 
            <div class="card bg-light " style="margin: 70px auto;">
                <div class="card-body">
                    <div style="padding: 0 20px">
                    <table class="table">
                    <tr>
                        <th scope="row"><?= __('Name') ?></th>
                        <td><?= h($topic->name) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Message Type') ?></th>
                        <td><?= $topic->has('mes_type') ? $this->Html->link($topic->mes_type->name, ['controller' => 'MesTypes', 'action' => 'view', $topic->mes_type->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Is Public') ?></th>
                        <td><?= $topic->is_public_topic ? "Yes" : "No" ?></td>
                    </tr>
                    </table>
                    <div class="text-center">
                        <?= $this->Html->link(__('Edit Topic'), ['action' => 'edit', $topic->id], ['class' => 'btn btn-primary']) ?>
                        <?= $this->Form->postLink(__('Delete Topic'), ['action' => 'delete', $topic->id], ['class' => 'btn btn-primary'],['confirm' => __('Are you sure you want to delete # {0}?', $topic->id)]) ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
