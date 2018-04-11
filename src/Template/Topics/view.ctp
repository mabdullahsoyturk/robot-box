<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Topic $topic
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Topic'), ['action' => 'edit', $topic->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Topic'), ['action' => 'delete', $topic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $topic->id)]) ?> </li>
    </ul>
</nav>
<div class="topics view large-9 medium-8 columns content">
    <h3><?= h($topic->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $topic->has('user') ? $this->Html->link($topic->user->id, ['controller' => 'Users', 'action' => 'view', $topic->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($topic->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mes Type') ?></th>
            <td><?= $topic->has('mes_type') ? $this->Html->link($topic->mes_type->name, ['controller' => 'MesTypes', 'action' => 'view', $topic->mes_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($topic->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max X') ?></th>
            <td><?= $this->Number->format($topic->max_x) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Min X') ?></th>
            <td><?= $this->Number->format($topic->min_x) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Y') ?></th>
            <td><?= $this->Number->format($topic->max_y) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Min Y') ?></th>
            <td><?= $this->Number->format($topic->min_y) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Robots') ?></h4>
        <?php if (!empty($topic->robots)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Ip Address') ?></th>
                <th scope="col"><?= __('Port') ?></th>
                <th scope="col"><?= __('Topic Id') ?></th>
                <th scope="col"><?= __('Map Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($topic->robots as $robots): ?>
            <tr>
                <td><?= h($robots->id) ?></td>
                <td><?= h($robots->user_id) ?></td>
                <td><?= h($robots->ip_address) ?></td>
                <td><?= h($robots->port) ?></td>
                <td><?= h($robots->topic_id) ?></td>
                <td><?= h($robots->map_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Robots', 'action' => 'view', $robots->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Robots', 'action' => 'edit', $robots->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Robots', 'action' => 'delete', $robots->id], ['confirm' => __('Are you sure you want to delete # {0}?', $robots->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
