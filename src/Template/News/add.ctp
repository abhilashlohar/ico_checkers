<div class="row py-3">
  <div class="col-md-12">
		<h4 class="mt-2 float-left">Create News</h4>
    <?php if ($user_role!="Admin") { ?>
      <a href="<?= $this->Url->build('/News/index') ?>" class="btn btn-outline-primary float-right">List of created news</a>
    <?php } ?>
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
  						<?php echo $this->Form->control('cover_image',['class'=>'form-control-file','type'=>'file']); ?>
  					</div>
  			</div>
			</div>
			<div class="row">
				<div class="col-md-12 mb-3">
					<div class="form-group">
							<?php echo $this->Form->control('description',['class'=>'form-control', 'type'=>'textarea', 'label'=>'News Description', 'rows'=>12]); ?>
					</div>
				</div>
			</div>
			<div class="row">
					<div class="col-md-9 mb-3">
							<div class="form-group">
									<?php echo $this->Form->control('tags',['class'=>'form-control', 'type'=>'textarea']); ?>
									<small id="tagsHelp" class="form-text text-muted">e.g.: tag1, tag2, tag3</small>
							</div>
					</div>
			</div>
      <div align="center" class="mb-3"><button type="submit" class="btn btn-primary btn-lg">Submit News for Approval</button></div>
			<?= $this->Form->end() ?>
	</div>
</div>
