<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?>
            <?php if (!$loggedIn): ?>
                <li><?= $this->Html->link(__('Login'), ['action' => 'login', 'controller' => 'users']) ?></li>
                <li><?= $this->Html->link(__('Sign Up'), ['action' => 'add', 'controller' => 'users']) ?></li>
            <?php else: ?>
                <li><?= $this->Html->link(__('My Robots'), ['action' => 'index', 'controller' => 'robots']) ?></li>
            <?php endif; ?>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <h1 class="header-title">Welcome to Robot Box</h1>
    <p>You can use this system to keep your robots reachable anytime!</p>

    <h2 class="subheader">Architecture</h2>
    <?= $this->Html->image("architecture.png") ?>

    <h2 class="subheader">Start Now!</h2>
    <p>Create a user and start using anytime!</p>
</div>
