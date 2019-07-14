<div class="row py-3">
    <div class="col-md-12">
        <form method="get">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="form-group">
					<label>Name</label>
                       <input type="text" name="name" class="form-control input-sm" value="<?= @$name ?>">
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="form-group">
					<label>Email</label>
                        <input type="email" name="email" class="form-control input-sm" value="<?= @$email ?>">
                    </div>
                </div>
				<div class="col-md-3 mb-3">
                    <div class="form-group">
					<label>Reason</label>
                        <?php $options = ['reason1' => 'Reason 1', 'reason2' => 'Reason 2' ,'reason3' => 'Reason 3']; ?>
					<?= $this->Form->control('reason', ['label' => false, 'class' => 'form-control input-sm', 'options' => $options, 'empty' => __('All reason'),'value'=>@$reason]); ?>
                    </div>
                </div>
				<div class="col-md-3 mb-3">
                    <div class="form-group">
					<label>Type</label>
                        <?php $options1 = ['contact' => 'contact', 'subscribe' => 'subscribe']; ?>
					<?= $this->Form->control('type', ['label' => false, 'class' => 'form-control input-sm', 'options' => $options1, 'empty' => __('All Type'),'value'=>@$type]); ?>
                    </div>
                </div>
            </div>
            
            
        <button type="submit" class="btn btn-primary">Find</button>
    </form>   
    </div>
</div>
<div class="row py-3">
    <div class="col-md-12">
        <h3><?= __('Inquiries') ?></h3>
		
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Reason</th>
                    <th>Type</th>
                    <th>Message</th>
                    <th>Created on</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inquiries as $inquiry): ?>
                <tr>
                    <td><?= h($inquiry->name) ?></td>
                    <td><?= h($inquiry->email) ?></td>
                    <td><?= h($inquiry->reason) ?></td>
                    <td><?= h($inquiry->type) ?></td>
                    <td><?= h($inquiry->message) ?></td>
                    <td><?= $this->Time->format($inquiry->created, 'dd MMM yyyy hh:mm a') ?></td>
                    <td>
					    <?php echo $this->Html->link(__(' Delete'), ['controller' => 'Enquiries', 'action' => 'delete', $inquiry->id]); ?>
					</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
</div>
