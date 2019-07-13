<div class="row py-3">
    <div class="col-md-12">
        <h4 class="mb-3">Edit task</h4>
        <?= $this->Form->create($task) ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <?php echo $this->Form->control('title',['class'=>'form-control']); ?>
                    </div>
                </div>
				<div class="col-md-2">
                    <div class="form-group">
                        <?php echo $this->Form->control('minimum_point',['class'=>'form-control', 'label' => 'Reward Point', 'min'=>0]); ?>
                    </div>
                </div>
				<div class="col-md-2">
                    <div class="form-group">
                        <?php echo $this->Form->control('end_days',['options'=>$day_option, 'class'=>'form-control','empty'=>'Select','value'=>$task->end_days, 'label'=>'Close After']); ?>
                    </div>
                </div>
            </div>
			
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <?php echo $this->Form->control('description',['class'=>'form-control', 'type'=>'textarea']); ?>
                    </div>
                </div>
            </div>
        <button type="submit" class="btn btn-primary">Edit task</button>
        <?= $this->Form->end() ?>
    </div>
</div>