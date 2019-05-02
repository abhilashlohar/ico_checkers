<div class="row py-3">
    <div class="col-md-12">
        <p>You wallet balance: <?= $wallet_balance ?></p>
    </div>
</div>

<div class="row py-3">
    <div class="col-md-6">
    	<?php if(!$Request){ ?>
	    	<?= $this->Form->create($Withdraw) ?>
	      <div class="card">
	        <div class="card-header"><h5>Send Withdraw Request</h5></div>
	        <div class="card-body">
	          <div class="row">
	            <div class="col-md-6 mb-3">
	              <div class="form-group">
	                  <?php echo $this->Form->control('points',['class'=>'form-control']); ?>
	              </div>
	            </div>
	            <div class="col-md-12 mb-3">
	              <div class="form-group">
	                  <?php echo $this->Form->control('comment',['class'=>'form-control','type'=>'textarea']); ?>
	              </div>
	            </div>
	          </div>
	        	<button type="submit" class="btn btn-primary">Send Request</button>
	        </div> 
	      </div>
	      <?= $this->Form->end() ?>
    	<?php }else{ ?> 
    		<div class="card">
	        <div class="card-header"><h5>Withdraw Request is in pending</h5></div>
	        <div class="card-body">
	          <div class="row">
	            <div class="col-md-12 mb-3">
	              <span>You have sent withdraw request of <b><?= $Request->points ?></b> points on <b><?= $Request->created_on->format("d-M-Y h:i A") ?></b>.</span>
	              <br><br>
	              <b>Message:</b>
	              <?= $this->Text->autoParagraph($Request->comment); ?>
	            </div>
	          </div>
	        	<?= $this->Form->postLink(__('Cancle Request'), ['action' => 'delete', $session_user_id], ['confirm' => __('Are you sure you want to cancle?'),'class'=>'btn btn-primary']) ?>
	        </div> 
	      </div>
    	<?php } ?>
    </div>
</div>

