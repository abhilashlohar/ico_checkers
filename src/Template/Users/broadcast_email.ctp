<div class="row py-3">
    <div class="col-md-12">
        <h4 class="mb-3">Brodcast Email</h4>
        <?= $this->Form->create($user) ?>
            <div class="row">
                <div class="col-md-6 mb-6">
                    <div class="form-group">
                        <?php echo $this->Form->control('send_to',['class'=>'form-control']); ?>
                    </div>
                </div>
			</div>
			<div class="row">
                <div class="col-md-12 mb-6">
                    <div class="form-group">
                        <?php echo $this->Form->control('message',['class'=>'form-control', 'type'=>'textarea']); ?>
                    </div>
                </div>
            </div>
        <button type="submit" class="btn btn-primary">Send email</button>
        <?= $this->Form->end() ?>
    </div>
</div>