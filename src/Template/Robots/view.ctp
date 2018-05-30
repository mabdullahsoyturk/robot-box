<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Robot $robot
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
                            <td><?= h($robot->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Ip Address') ?></th>
                            <td><?= $robot->is_public_robot ? "Public Robot" : h($robot->ip_address) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Port') ?></th>
                            <td><?= $robot->is_public_robot ? "Public Robot" : h($robot->port) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Topic') ?></th>
                            <td><?= $robot->has('topic') ? $this->Html->link($robot->topic->name, ['controller' => 'Topics', 'action' => 'view', $robot->topic->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Is Public') ?></th>
                            <td><?=$robot->is_public_robot ? "Yes" : "No" ?></td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <?= $this->Html->link(__('Edit Robot'), ['action' => 'edit', $robot->id], ['class' => 'btn btn-primary']) ?>
                        <?= $this->Form->postLink(__('Delete Robot'), ['action' => 'delete', $robot->id], ['class' => 'btn btn-primary'],['confirm' => __('Are you sure you want to delete # {0}?', $robot->id)]) ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>