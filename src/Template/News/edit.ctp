<div class="row py-3">
    <div class="col-md-12">
        <h4 class="mb-3">Edit news</h4>
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
                      <?php echo $this->Form->control('cover_image',['class'=>'form-control','type'=>'file']); ?>
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
            <div class="row">
                <div class="col-md-9 mb-3">
                    <div class="form-group">
                        <?php echo $this->Form->control('tags',['class'=>'form-control', 'type'=>'text']); ?>
                        <small id="tagsHelp" class="form-text text-muted">e.g.: tag1, tag2, tag3</small>
                    </div>
                </div>
            </div>
        <button type="submit" class="btn btn-primary">Edit news</button>
        <?= $this->Form->end() ?>
    </div>
</div>
