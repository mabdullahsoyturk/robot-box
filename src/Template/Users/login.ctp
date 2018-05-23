<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6"> 
             <div class="card bg-light " style="max-width: 27rem;margin: 70px auto;">
                <div class="card-body">
                    <div style="padding: 0 20px">
                        <h1 class="text-center font-weight-bold" style="margin-bottom: 20px;  color: grey">Log In</h1>
                        <hr class="my-2" >
                            <?= $this->Form->create() ?>
                            <fieldset>
                                <?php
                                echo $this->Form->control('email');
                                echo $this->Form->control('password');
                                ?>
                            </fieldset>
                            <?= $this->Form->button(__('Log In'), ['class' => 'btn btn-primary btn-md btn-block']) ?>
                            <?= $this->Form->end() ?>
                            <p class="text-center" style="margin-top: 10px; color: grey;">or <span class="font-weight-bold"><?= $this->Html->link(__('Forgot Password'), ['action' => 'forgotPassword']) ?></span></p>
                        <hr style="border-color: grey">
                        <div class="text-center", style="color: grey;">
                            Don't have an account? <span class="font-weight-bold"><?= $this->Html->link(__('Sign Up'), ['action' => 'add']) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>