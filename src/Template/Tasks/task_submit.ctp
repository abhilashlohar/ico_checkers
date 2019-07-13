<?php
$this->Html->css(['blog'], ['block' => true]);
?>
<div class="my-3 task-body p-3" >
	<h1 class="task_title mb-0"><?= $task->title ?></h1>
	<div class="text-muted mb-2" style="font-size: 14px;"><?php echo date('d M, Y',strtotime($task->created_on))?></div>
	<div>
		<?= $this->Text->autoParagraph($task->description) ?>
	</div>
</div>

<div class="mb-3 task-body p-3" >
	<?php if(!empty($task_proofs)){?>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<?php echo $this->Html->image(str_replace('\\','/',$task_proofs->image),['class'=>'img-thumbnail', 'style' => 'max-width:100%;']); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<?= $this->Text->autoParagraph($task_proofs->message) ?>
				</div>
			</div>
		</div>
	<?php }else{ ?>
		<?= $this->Form->create($task,['type'=>'file']) ?>
		<h3>Submit Proof</h3>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
				  <?php echo $this->Form->control('image',['class'=>'form-control-file','type'=>'file']); ?>
				 	<?php echo $this->Form->control('task_id',['type'=>'hidden','value'=>$task->id]); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<?php echo $this->Form->control('message',['class'=>'form-control', 'type'=>'textarea']); ?>
				</div>
			</div>
		</div>
		<?= $this->Form->button($this->Html->tag('i', '', ['class' => 'fa fa-check']).__(' Send proof'), ['escape' => false, 'class' => 'btn btn-success']); ?>
		<?= $this->Form->end() ?>  
	<?php } ?>
</div>



