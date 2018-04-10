<h1><? __('Login') ?></h1>
<?= $this->Form->create() ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button(__('Login')) ?>
<?= $this->Form->end() ?>
