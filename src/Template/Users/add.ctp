<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>



<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-6"> 
             <div class="card bg-light " style="max-width: 27rem;margin: 130px auto;">
                <div class="card-body">
                    

                    <div style="padding: 0 20px">
                        <strong><p class="text-center" style="margin: 0; font-size: 40px; color: grey">Sign Up</p></strong>
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
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-md btn-block']) ?>
                    <?= $this->Form->end() ?>
                    
                    <hr style="border-color: grey">

                    <div class="pull-right", style="color: grey;">
                        Already have an account?    <?= $this->Html->link(__('Log In'), ['action' => 'login']) ?>
                    </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>




