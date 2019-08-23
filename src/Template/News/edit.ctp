<div class="row py-3">
  <div class="col-md-12">
		<h4 class="mt-2 float-left">Edit News</h4>
  </div>
</div>
<div class="row">
	<div class="col-md-12">
		<?= $this->Form->create($news,['type'=>'file']) ?>
			<div class="row">
				<div class="col-md-6 mb-3">
						<div class="form-group">
								<?php echo $this->Form->control('title',['class'=>'form-control']); ?>
						</div>
				</div>
				<div class="col-md-3">
						<div class="form-group">
							<?php echo $this->Form->control('category',['options'=>['India'=>'India','Foreign'=>'Foreign'], 'class'=>'form-control']); ?>
						</div>
				</div>
  			<div class="col-md-3">
  					<div class="form-group">
  						<?php
  							if ($news->cover_image!='') {
  								echo $this->Html->image(str_replace('\\','/',@$news->cover_image),['class'=>'img-thumbnail','style'=>'max-height:200px;']);
  								echo '<br>';
  							};
  							echo $this->Form->control('cover_image',['class'=>'form-control-file','type'=>'file']);
  						?>
  					</div>
  			</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
							<?php echo $this->Form->control('description',['class'=>'form-control', 'type'=>'textarea', 'label'=>'News Description', 'rows'=>12]); ?>
					</div>
				</div>
			</div>
			<div class="row">
					<div class="col-md-9">
							<div class="form-group">
									<?php echo $this->Form->control('tags',['class'=>'form-control', 'type'=>'textarea']); ?>
									<small id="tagsHelp" class="form-text text-muted">e.g.: tag1, tag2, tag3</small>
							</div>
					</div>

					<?php if ($user_role=='Admin'){ ?>
						<div class="col-md-3">
								<div class="form-group">
										<?php echo $this->Form->control('status',[
											'options'=>['Pending for approval'=>'Pending','Rejected'=>'Reject','Approved'=>'Approve'], 
											'class'=>'form-control'
										]); ?>
								</div>
						</div>
					<?php } ?>
					
			</div>
      <div align="center" class="mb-3"><button type="submit" class="btn btn-primary btn-lg">Updates News</button></div>
			<?= $this->Form->end() ?>
	</div>
</div>

