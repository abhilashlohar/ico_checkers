<div class="row py-3">
    <div class="col-md-12">
        <h4 class="mb-3">Message</h4>
        <?= $this->Form->create($users,['type'=>'file','id'=>'target']) ?>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <?php echo $this->Form->control('message',['class'=>'form-control', 'type'=>'textarea','label'=>false]); ?>
                    </div>
                </div>
            </div>
		<?= $this->Form->unlockField('h_type') ?>
		<?php echo $this->Form->control('h_type',['id'=>'h_type', 'type'=>'hidden','value'=>'']); ?>
        <button type="submit" class="btn btn-primary">Save & Select User</button>
		<button type="button" class="btn btn-primary btn_all">Send All User</button>
        <?= $this->Form->end() ?>
    </div>
</div>
<?php echo $this->fetch('postLink'); ?>
<?=
$this->Html->scriptBlock(" 
$(document).on('click', '.btn_all', function(){ 
  
  $('#h_type').val('send_all');
  $('#target').submit();
});
 
", ['block' => true]); ?>

