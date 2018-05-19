<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Topic $topic
 */
?>
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('List Topics'), ['action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Add a New Message Type'), ['action' => 'add', 'controller' => 'MesTypes']) ?></li>
        </ul>
    </nav>
    <div class="topics form large-9 medium-8 columns content">
        <?= $this->Form->create($topic, ['id' => 'topic-form']) ?>
        <fieldset>
            <legend><?= __('Add Topic') ?></legend>
            <?php
            echo $this->Form->control('name');
            echo $this->Form->control('mes_id', ['options' => $mesTypes]);
            echo (isset($admin) && $admin) ? $this->Form->control('is_public_topic') : "";
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