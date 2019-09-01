<div class="row py-3">
  <div class="col-md-12">
    <h4 class="mt-2 float-left">Create Task</h4>
    <?php if ($user_role!="Admin") { ?>
      <a href="<?= $this->Url->build('/tasks/index') ?>" class="btn btn-outline-primary float-right">List of created tasks</a>
    <?php } ?>
  </div>
</div>
<div class="row py-3">
  <div class="col-md-12">
    <?= $this->Form->create($task) ?>
    <div class="row">
      <div class="col-md-8">
        <div class="form-group">
          <?php echo $this->Form->control('title',['class'=>'form-control']); ?>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <?php echo $this->Form->control('minimum_point',['class'=>'form-control', 'label' => 'Reward MDI Coins', 'min'=>0]); ?>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <?php echo $this->Form->control('end_days',['options'=>$day_option, 'class'=>'form-control','empty'=>'Select', 'label'=>'Close After']); ?>
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
    <button type="submit" class="btn btn-primary">Add task</button>
    <?= $this->Form->end() ?>
  </div>
</div>