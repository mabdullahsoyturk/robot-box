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
                        <h1 class="text-center font-weight-bold" style="margin-bottom: 20px;  color: grey">Add Message Type</h1>
                            <hr class="my-2" >
                                <?= $this->Form->create($mesType) ?>
                                <fieldset>
                                    <legend><?= __("Message Type Example") ?></legend>
                                    <?= $this->Html->image("sample_message_type.png") ?>
                                    <p>
                                        Name : turtlesim/Pose<br>
                                        X Parameter : x<br>
                                        Y Parameter : y<br>
                                        Theta Parameter : theta
                                    </p>
                                </fieldset>
                                <fieldset>
                                    <legend><?= __('Add Message Type') ?></legend>
                                    <?php
                                        echo $this->Form->control('name');
                                        echo $this->Form->control('x_par', ['label' => 'X Parameter']);
                                        echo $this->Form->control('y_par', ['label' => 'Y Parameter']);
                                        echo $this->Form->control('t_par', ['label' => 'Theta(Angle) Parameter']);
                                        echo isset($admin) && $admin ? $this->Form->control("is_public_message_type") : "";
                                    ?>
                                </fieldset>
                                <?= $this->Form->button(__('Add')) ?>
                                <?= $this->Form->end() ?>
                                <hr style="border-color: grey">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
