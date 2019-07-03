<div class="row py-3">
    <div class="col-md-12">
        <h2><?= h($airdrop->name) ?></h2>
        <?php  ?>
            <p><?= $this->Time->format($airdrop->created_on, 'd MMM, Y') ?></p>
		<?php if($airdrop->project_quality!=''){ ?>
       <p><b>Project Quality</b> &nbsp;&nbsp;<?php 
	   for($i=1;$i<=$airdrop->project_quality; $i++){
		echo $this->Html->Image('star.png'); 
	   }
	   ?></p><?php } 
		if($airdrop->strangeness!=''){
	   ?>
		<p><b>Strangeness</b> &nbsp;&nbsp;<?php 
	   for($i=1;$i<=$airdrop->strangeness; $i++){
		echo $this->Html->Image('star.png'); 
	   }
	   
	   ?></p>
	   <?php } 
		if($airdrop->different_ico!=''){
	   ?>
	   <p><b>Different ICo</b> &nbsp;&nbsp;<?php 
	   for($i=1;$i<=$airdrop->different_ico; $i++){
		echo $this->Html->Image('star.png'); 
	   }
	   
	   ?></p>
		<?php } 
		if($airdrop->different_ico!=''){
	   ?>
	   <p><b>Actual Use</b> &nbsp;&nbsp;<?php 
	   for($i=1;$i<=$airdrop->actual_use; $i++){
		echo $this->Html->Image('star.png'); 
	   }
	   
	   ?></p>
		<?php } 
		if($airdrop->different_ico!=''){
	   ?>
	   <p><b>Team</b> &nbsp;&nbsp;<?php 
	   for($i=1;$i<=$airdrop->team; $i++){
		echo $this->Html->Image('star.png'); 
	   }
	   
	   ?></p><?php } ?>
		<p><?= $airdrop->country ?></p>
		<p><?= $airdrop->Email ?></p>
		 
        <?= $airdrop->link ?>
    </div>
</div>