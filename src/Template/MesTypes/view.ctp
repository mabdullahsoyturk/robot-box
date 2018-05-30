<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesType $mesType
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
                            <td><?= h($mesType->name) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('X Par') ?></th>
                            <td><?= h($mesType->x_par) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Y Par') ?></th>
                            <td><?= h($mesType->y_par) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('T Par') ?></th>
                            <td><?= h($mesType->t_par) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Is Public') ?></th>
                            <td><?= $mesType->is_public_message_type ? "Yes" : "No"?></td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <?= $this->Html->link(__('Edit Message Type'), ['action' => 'edit', $mesType->id], ['class' => 'btn btn-primary']) ?>
                        <?= $this->Form->postLink(__('Delete Message Type'), ['action' => 'delete', $mesType->id], ['class' => 'btn btn-primary'],['confirm' => __('Are you sure you want to delete # {0}?', $mesType->id)]) ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
