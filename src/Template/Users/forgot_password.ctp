<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6"> 
             <div class="card bg-light " style="max-width: 27rem;margin: 130px auto;">
                <div class="card-body">
                    <div style="padding: 0 20px">
                        <h1 class="text-center font-weight-bold" style="margin-bottom: 20px;  color: grey">Reset Password</h1>
                        <hr class="my-2" >
                        <?= $this->Form->create(null) ?>
                        <?= $this->Form->Control('email') ?>
                        <?= $this->Form->button(('Send Password Reset Link'), ['class' => 'btn btn-primary btn-md btn-block']) ?>
                        <?= $this->Form->end(); ?>
                        <hr style="border-color: grey">
                        <div class="pull-right", style="color: grey;">
                            Did you remember?   <span class="font-weight-bold"><?= $this->Html->link(__('Log In'), ['action' => 'login', 'controller' => 'users']) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>