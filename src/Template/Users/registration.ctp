<div class="row py-3">
    <div class="col-md-12">
        <h4 class="mb-3">Registration</h4>
        <?= $this->Form->create($user) ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $this->Form->control('name', ['label' => ['text' => __('Name'), 'class' => 'control-label'], 'class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <?= $this->Form->control('email', ['label' => ['text' => __('Email'), 'class' => 'control-label'], 'class' => 'form-control']) ?>
                    </div>
                </div>
				<div class="col-md-6">
                    <div class="form-group">
                     <?= $this->Form->control('mobile', ['label' => ['text' => __('Mobile'), 'class' => 'control-label'], 'class' => 'form-control']); ?>
                    </div>
                </div>
				<div class="col-md-6">
                    <div class="form-group">
                     <?php $options = ['1' => 'Active', '0' => 'Inactive']; ?>
                    <?= $this->Form->control('status', ['label' => ['text' => __('Status'), 'class' => 'control-label'], 'class' => 'form-control', 'options' => $options, 'empty' => __('Select Status'), 'default' => 1, 'required' => true]); ?>
                    </div>
                </div>
				<div class="col-md-6">
                    <div class="form-group">
                    <?= $this->Form->control('password', ['label' => ['text' => __('Password'), 'class' => 'control-label'], 'class' => 'form-control', 'templateVars' => ['labelIcon' => __('Password')]]) ?>
                    </div>
                </div>
				<div class="col-md-6">
                    <div class="form-group">
                   <?= $this->Form->control('confirm_password', ['label' => ['text' => __('Confirm Password'), 'class' => 'control-label'], 'class' => 'form-control', 'type' => 'password']) ?>
                    </div>
                </div>
				<div class="col-md-6">
                    <div class="form-group">
                   <?php $options = ['Admin' => 'Admin', 'Editor' => 'Editor']; ?>
                    <?= $this->Form->control('role', ['label' => ['text' => __('Role'), 'class' => 'control-label'], 'class' => 'form-control', 'options' => $options, 'empty' => __('Select Role')]); ?>
                    </div>
                </div>
            </div>
            
        <button type="submit" class="btn btn-primary">Save</button>
        <?= $this->Form->end() ?>
    </div>
</div>
