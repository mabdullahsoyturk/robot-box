<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Login'), ['action' => 'login', 'controller' => 'users']) ?></li>
        <li><?= $this->Html->link(__('Sign Up'), ['action' => 'add', 'controller' => 'users']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <h1 class="header-title">Forgot Password?</h1>
    <p>No need to worry</p>
    <?= $this->Form->create(null) ?>
    <?= $this->Form->Control('email') ?>
    <?= $this->Form->button('Send Password Reset Link') ?>
    <?= $this->Form->end(); ?>
</div>
