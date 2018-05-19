<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Robot $robot
 */
?>

<div class="robots form large-12 medium-8 columns content">
    <?= $this->Form->create($robot, ['id' => 'robot-form']) ?>
    <fieldset>
        <legend><?= __('Edit Robot') ?></legend>
        <?php
        echo $this->Form->control('name');
        echo $this->Form->control('ip_address');
        echo $this->Form->control('port');
        echo $this->Form->control('topic_id', ['options' => $topics]);
        echo (isset($admin) && $admin ? $this->Form->control('is_public_robot') : "");
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>


<?php if (isset($admin) && $admin): ?>
    <?php $this->append('script') ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#robot-form').on('submit', function(e){
                e.preventDefault();
                let privateTopicIds = [  <?php foreach ($topics['Private Topics'] as $key => $val) {echo  $key . ",";} ?> ];
                if($("input[name=is_public_robot][type=checkbox]")[0].checked){
                    let topicId = Number($("#topic-id").val());
                    if(privateTopicIds.indexOf(topicId) === -1){
                        this.submit();
                    }else{
                        alert("You cannot use private topics with public robots");
                    }
                }else{
                    this.submit();
                }
            });
        });
    </script>
    <?php $this->end(); ?>
<?php endif; ?>

