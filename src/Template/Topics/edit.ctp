<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Topic $topic
 */
?>

<div class="topics form large-12 medium-8 columns content">
    <?= $this->Form->create($topic, ['id' => 'topic-form']) ?>
    <fieldset>
        <legend><?= __('Edit Topic') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('mes_id', ['options' => $mesTypes]);
            echo $this->Form->control('is_public_topic',
                [ (isset($admin) && $admin) ? '' : 'disabled' => (isset($admin) && $admin) ? '' : 'disabled']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>


<?php if (isset($admin) && $admin): ?>
    <?php $this->append('script') ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#topic-form').on('submit', function(e){
                e.preventDefault();
                let privateMessageTypeIds = [  <?php foreach ($mesTypes['Private Message Types'] as $key => $val) {echo  $key . ",";} ?> ];
                if($("input[name=is_public_topic][type=checkbox]")[0].checked){
                    let mesTypeId = Number($("#mes-id").val());
                    if(privateMessageTypeIds.indexOf(mesTypeId) === -1){
                        this.submit();
                    }else{
                        alert("You cannot use private message types with public topics");
                    }
                }else{
                    this.submit();
                }
            });
        });
    </script>
    <?php $this->end(); ?>
<?php endif; ?>