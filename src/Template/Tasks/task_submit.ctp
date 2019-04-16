<?php
$this->Html->css(['blog'], ['block' => true]);
?>
<div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
         
        </div>
      </header>
		<div class="row mb-2">
			<div class="col-md-12">
			  <div class="card flex-md-row mb-4 box-shadow h-md-250">
				<div class="card-body d-flex flex-column align-items-start">
				  <h3 class="mb-0">
					<a class="text-dark" href="<?= $this->Url->build(['controller'=>'Tasks','action'=>'taskSubmit',$task->id])?>"><?= $task->title ?></a>
				  </h3>
				  <div class="mb-1 text-muted"><?php echo date('d M, Y',strtotime($task->created_on))?></div>
				  <p class="card-text mb-auto"><?= $task->description ?></p>
				</div>
				
			  </div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="card flex-md-row mb-4 box-shadow h-md-250">
					<div class="card-body d-flex flex-column align-items-start">

						<?php if(!empty($task_proofs)){?>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<?php echo $this->html->image(str_replace('\\','/',$task_proofs->image),['class'=>'img-thumbnail']); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mb-12">
									<div class="form-group">
										<?php echo $task_proofs->message; ?>
									</div>
								</div>
							</div>
						<?php }else{ ?>
							<?= $this->Form->create($task,['type'=>'file']) ?>
							<h4>Submit Proof</h4>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <?php echo $this->Form->control('image',['class'=>'form-control-file','type'=>'file']); ?>
									  <input type="hidden" name="task_id" value="<?= $task->id ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mb-12">
									<div class="form-group">
										<?php echo $this->Form->control('message',['class'=>'form-control', 'type'=>'textarea']); ?>
									</div>
								</div>
							</div>
							<?= $this->Form->button($this->Html->tag('i', '', ['class' => 'fa fa-check']).__(' Send proof'), ['escape' => false, 'class' => 'btn btn-success']); ?>
							<?= $this->Form->end() ?>  
						<?php } ?>
					</div>
				</div>		
			</div>
		</div>
    </div>