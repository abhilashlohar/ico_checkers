<div class="row py-3">
    <div class="col-md-12">
        <h4 class="mb-3">Message</h4>
        <?= $this->Form->create($users,['type'=>'file']) ?>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <?php echo $this->Form->control('message',['class'=>'form-control', 'type'=>'textarea','label'=>false]); ?>
                    </div>
                </div>
            </div>
        <button type="submit" class="btn btn-primary">Save & Select User</button>
        <?= $this->Form->end() ?>
    </div>
</div>
