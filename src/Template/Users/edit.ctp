<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9"> 
             <div class="card bg-light " style="margin: 70px auto;">
                <div class="card-body">
                    <div style="padding: 0 20px">
                        <h1 class="text-center font-weight-bold" style="margin-bottom: 20px;  color: grey"><?= __('Edit User')?></h1>
                        <hr class="my-2">
                        <?= $this->Form->create($user) ?>
                        <fieldset>
                            <legend><?= __('Edit User') ?></legend>
                            <?php
                                echo $this->Form->control('email');
                                echo $this->Form->control('password');
                                echo $this->Form->control('activation_code');
                                echo $this->Form->control('activated');
                                echo $this->Form->control('forgotten_password_code');
                                echo $this->Form->control('first_name');
                                echo $this->Form->control('last_name');
                            ?>
                        </fieldset>
                        <?= $this->Form->button(__('Submit')) ?>
                        <?= $this->Form->end() ?>
                        <hr style="border-color: grey">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
