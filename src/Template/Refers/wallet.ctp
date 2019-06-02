
<div class="row py-3">
    <div class="col-md-12">
        <p>You wallet balance: <?= $wallet_balance ?></p>
    </div>
</div>

<div class="row py-3">
    <div class="col-md-6">
    	<?php if(!$Request){ ?>
	    	<?= $this->Form->create($Withdraw,['id'=>'form1']) ?>
	      <div class="card">
	        <div class="card-header"><h5>Send Withdraw Request</h5></div>
	        <div class="card-body">
	          <div class="row">
	            <div class="col-md-6 mb-3">
	              <div class="form-group">
	                  <?php $mode =  ['google_pay'=>'Google pay','paypal'=>'Paypal','ethereum'=>'Ethereum']; ?>
					  <?php echo $this->Form->control('payment_mode',['options'=>$mode, 'class'=>'form-control','empty'=>'Select','required'=>'required']); ?>
	              </div>
	            </div>
	            <div class="col-md-12 mb-3">
	              <div class="form-group" style="display:none;">
	                  <?php echo $this->Form->control('google_mobile_no',['class'=>'form-control google']); ?>
				  </div>
				 <div class="form-group" style="display:none;">
	                  <?php echo $this->Form->control('paypal_email',['class'=>'form-control paypal','type'=>'email']); ?>
				  </div>
				  <div class="form-group" style="display:none;">
	                  <?php echo $this->Form->control('ethereum_address',['class'=>'form-control ethereum']); ?>
	              </div>
	            </div>
				 <div class="col-md-12 mb-3">
					<div class="form-group">
	                  <?php echo $this->Form->control('points',['class'=>'form-control','required'=>'required','max'=>$wallet_balance,'step'=>0]); ?>
					  
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
<?= $this->Html->scriptBlock("
$(document).on('change', '#payment-mode', function() {
    var pay = $(this).val();
	if(pay=='google_pay')
	{
		$('.google').parents('div.form-group').show();
		$('.google').attr('required','required');
		$('.paypal').parents('div.form-group').hide();
		$('.paypal').removeAttr('required');
		$('.ethereum').parents('div.form-group').hide();
		$('.ethereum').removeAttr('required');
	}
	else if(pay=='paypal')
	{
		$('.paypal').parents('div.form-group').show();
		$('.paypal').attr('required','required');
		$('.google').parents('div.form-group').hide();
		$('.google').removeAttr('required');
		$('.ethereum').parents('div.form-group').hide();
		$('.ethereum').removeAttr('required');
	}
	else if(pay=='ethereum')
	{
		$('.ethereum').parents('div.form-group').show();
		$('.ethereum').attr('required','required');
		$('.paypal').parents('div.form-group').hide();
		$('.paypal').removeAttr('required');
		$('.google').parents('div.form-group').hide();
		$('.google').removeAttr('required');
	}
});

", ['block' => true]);
