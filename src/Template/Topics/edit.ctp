<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Topic $topic
 */
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
             <div class="card bg-light " style="margin: 70px auto;">
                <div class="card-body">
                    <div style="padding: 0 20px">
                        <h1 class="text-center font-weight-bold" style="margin-bottom: 20px;  color: grey"><?= __('Edit Topic')?></h1>
                        <hr class="my-2">
                        <?= $this->Form->create($topic, ['id' => 'topic-form']) ?>
                        <fieldset>
                            <?php
                                echo $this->Form->control('name');
                                echo $this->Form->control('mes_id', ['options' => $mesTypes]);
                                echo $this->Form->control('is_public_topic',
                                    [ (isset($admin) && $admin) ? '' : 'disabled' => (isset($admin) && $admin) ? '' : 'disabled']);
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
