<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Map $map
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Map'), ['action' => 'edit', $map->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Map'), ['action' => 'delete', $map->id], ['confirm' => __('Are you sure you want to delete # {0}?', $map->id)]) ?> </li>
    </ul>
</nav>
<div class="maps view large-9 medium-8 columns content">
    <h3><?= h($map->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Width') ?></th>
            <td><?= $this->Number->format($map->width) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Height') ?></th>
            <td><?= $this->Number->format($map->height) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Space') ?></th>
            <td><?= $this->Html->image("space_". $map->space) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('X Zero') ?></th>
            <td><?= $this->Number->format($map->x_zero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Y Zero') ?></th>
            <td><?= $this->Number->format($map->y_zero) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Robots') ?></h4>
        <?php if (!empty($map->robots)): ?>
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
            <?php foreach ($map->robots as $robots): ?>
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
