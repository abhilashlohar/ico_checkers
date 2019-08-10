<div class="row py-3">
    <div class="col-md-12">
        <h4 class="mb-3">Edit ICO Review</h4>
        <?= $this->Form->create($airdrop) ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <?php echo $this->Form->control('name',['class'=>'form-control', 'label'=>'ICO Name']); ?>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="form-group">
                        <?php echo $this->Form->control('country',['class'=>'form-control']); ?>
                    </div>
                </div>
            </div>
			<div class="row">
               <div class="col-md-12 mb-12">
			    <div class="form-group">
				<?php echo $this->Form->control('description',['class'=>'form-control', 'label'=>'Description','rows'=>3]); ?>
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
            
			<h4>Rating</h4>
			<div class="row">
				<div class="col-md-12 mb-12">
				<table class="table">
					<tr>
						<th>Project Quality</th>
						<td>
							<?php $options=['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10']; 
							echo $this->Form->control('project_quality', ['label' => false, 'class' => 'form-control form-filter input-sm', 'options' => $options, 'empty' => __('Project Quality')]); ?>
						</td>
						<th>strongness</th>
						<td>
							<?php  echo $this->Form->control('strongness', ['label' => false, 'class' => 'form-control form-filter input-sm', 'options' => $options, 'empty' => __('strongness')]); ?>
						</td>
					</tr>
					<tr>
						<th>Different ico</th>
						<td>
							<?php 
							echo $this->Form->control('different_ico', ['label' => false, 'class' => 'form-control form-filter input-sm', 'options' => $options, 'empty' => __('Different ico')]); ?>
						</td>
						<th>Actual use</th>
						<td>
							<?php  echo $this->Form->control('actual_use', ['label' => false, 'class' => 'form-control form-filter input-sm', 'options' => $options, 'empty' => __('Actual use')]); ?>
						</td>
					</tr>
					<tr>
						<th>Team</th>
						<td>
							<?php 
							echo $this->Form->control('team', ['label' => false, 'class' => 'form-control form-filter input-sm', 'options' => $options, 'empty' => __('Team')]); ?>
						</td>
					</tr>
				</table>	
				</div>
			</div>
			<div class="row">
               <div class="col-md-12 mb-12">
			    <div class="form-group">
					<?php echo $this->Form->control('comment',['class'=>'form-control', 'label'=>'Our Comment','rows'=>3]); ?>
				</div>
			   </div>
            </div>
        <button type="submit" class="btn btn-primary my-btn">Edit</button>
        <?= $this->Form->end() ?>
    </div>
</div>
