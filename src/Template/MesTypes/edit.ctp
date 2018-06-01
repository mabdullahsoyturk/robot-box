<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MesType $mesType
 */
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
             <div class="card bg-light " style="margin: 70px auto;">
                <div class="card-body">
                    <div style="padding: 0 20px">
                        <h1 class="text-center font-weight-bold" style="margin-bottom: 20px;  color: grey"><?= __('Edit Message Type')?></h1>
                        <hr class="my-2">
                        <?= $this->Form->create($mesType) ?>
                        <fieldset>
                            <?php
                                echo $this->Form->control('name');
                                echo $this->Form->control('x_par');
                                echo $this->Form->control('y_par');
                                echo $this->Form->control('t_par');
                                echo isset($admin) && $admin ? $this->Form->control("is_public_message_type") : "";
                            ?>
                        </fieldset>
                        <div class="text-center"><?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?></div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
