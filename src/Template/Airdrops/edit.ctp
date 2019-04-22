<div class="row py-3">
    <div class="col-md-12">
        <h4 class="mb-3">Edit Airdrop</h4>
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
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <?php echo $this->Form->control('link',['class'=>'form-control']); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <?php echo $this->Form->control('email',['class'=>'form-control', 'label'=>'CEO/Founder Email']); ?>
                    </div>
                </div>
            </div>
        <button type="submit" class="btn btn-primary">Add</button>
        <?= $this->Form->end() ?>
    </div>
</div>
