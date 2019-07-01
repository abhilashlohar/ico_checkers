<div class="row py-3">
    <div class="col-md-12">
        <h4 class="mb-3">Add ICO Review</h4>
        <?= $this->Form->create($airdrop) ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <?php echo $this->Form->control('name',['class'=>'form-control', 'label'=>'ICO Name']); ?>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <?php echo $this->Form->control('country',['class'=>'form-control']); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <?php echo $this->Form->control('link',['class'=>'form-control','label'=>'Website']); ?>
                    </div>
                </div>
				 <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <?php echo $this->Form->control('email',['class'=>'form-control', 'label'=>'CEO/Founder Email']); ?>
                    </div>
                </div>
            </div>
            <div class="row">
               <div class="col-md-6 mb-3">
				<?php echo $this->Form->control('description',['class'=>'form-control', 'label'=>'Descriotion']); ?>
			   </div>
			   <div class="col-md-6 mb-3">
				<?php echo $this->Form->control('comment',['class'=>'form-control', 'label'=>'Comment']); ?>
			   </div>
            </div>
			<h4>Rating</h4>
			<div class="row">
				<div class="col-md-6 mb-3">
				  <?php echo $this->Form->control('project_quality',['class'=>'form-control','min'=>0,'min'=>10]); ?>
				 </div>
				 <div class="col-md-6 mb-3">
				  <?php echo $this->Form->control('strangeness',['class'=>'form-control','min'=>0,'min'=>10]); ?>
				 </div>
			</div>
			<div class="row">
				<div class="col-md-6 mb-3">
				  <?php echo $this->Form->control('different_ico',['class'=>'form-control','min'=>0,'min'=>10]); ?>
				 </div>
				 <div class="col-md-6 mb-3">
				  <?php echo $this->Form->control('actual_use',['class'=>'form-control','min'=>0,'min'=>10]); ?>
				 </div>
				 <div class="col-md-6 mb-3">
				  <?php echo $this->Form->control('team',['class'=>'form-control','min'=>0,'min'=>10]); ?>
				 </div>
			</div>
        <button type="submit" class="btn btn-primary">Add</button>
        <?= $this->Form->end() ?>
    </div>
</div>
