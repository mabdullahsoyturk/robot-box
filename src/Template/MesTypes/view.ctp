<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesType $mesType
 */
?>
<div class="container" style="margin-top:30px;">
    <hr align="left" >
        <h3><?= h($mesType->name) ?></h3>
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
</div>
