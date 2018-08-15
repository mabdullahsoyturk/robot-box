<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Login'), ['action' => 'login', 'controller' => 'users']) ?></li>
        <li><?= $this->Html->link(__('Sign Up'), ['action' => 'add', 'controller' => 'users']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <h1 class="header-title"><?php echo __('Reset Password'); ?></h1>
    <p><?php echo __('Pick a password that is both strong and easy to remember'); ?></p>
    <?= $this->Form->create(null) ?>
    <?= $this->Form->Control('password', ['label' => 'Your New Password']) ?>
    <?= $this->Form->Control('password2', ['label' => 'Again..', 'type' => 'password']) ?>
    <?= $this->Form->button('Reset My Password') ?>
    <?= $this->Form->end(); ?>
</div>
