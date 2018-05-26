<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Robot $robot
 */
?>
<div class="container" style="margin-top:30px;">
    <hr align="left" >
        <h3><?= h($robot->name) ?></h3>
        <table class="vertical-table">
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
</div>