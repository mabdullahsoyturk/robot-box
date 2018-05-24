<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6"> 
             <div class="card bg-light " style="max-width: 27rem;margin: 70px auto;">
                <div class="card-body">
                    <div style="padding: 0 20px">
                        <h1 class="text-center font-weight-bold" style="margin-bottom: 20px;  color: grey">Sign Up</h1>
                        <hr class="my-2" >
                        <?= $this->Form->create($user) ?>
                        <fieldset>
                            <?php
                                echo $this->Form->control('email');
                                echo $this->Form->control('password');
                                echo $this->Form->control('first_name');
                                echo $this->Form->control('last_name');
                            ?>
                        </fieldset>
                        <?= $this->Form->button(__('Sign Up'), ['class' => 'btn btn-primary btn-md btn-block']) ?>
                        <?= $this->Form->end() ?>
        
                        <hr style="border-color: grey">

                        <div class="pull-right text-custom", style="color: grey;">
                            Already have an account?   <span class="font-weight-bold"><?= $this->Html->link(__('Log In'), ['action' => 'login']) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>