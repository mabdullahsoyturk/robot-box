<?php if (!$loggedIn): ?>


<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?>
                <li><?= $this->Html->link(__('Login'), ['action' => 'login', 'controller' => 'users']) ?></li>
                <li><?= $this->Html->link(__('Sign Up'), ['action' => 'add', 'controller' => 'users']) ?></li>
    </ul>
</nav>
<?php endif; ?>

<div class="users form large-9 medium-8 columns content">
    <h1 class="header-title">Welcome to Robot Box</h1>
    <p>You can use this system to keep your robots reachable anytime!</p>

    <h2 class="subheader">Architecture</h2>
    <?= $this->Html->image("architecture.png") ?>

    <?php if (!$loggedIn): ?>
        <h2 class="subheader">Start Now!</h2>
        <p>Create a user and start using anytime!</p>
    <?php endif; ?>

</div>
