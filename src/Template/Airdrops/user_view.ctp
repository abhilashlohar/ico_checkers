<div class="row py-3">
    <div class="col-md-12">
        <h2><?= h($airdrop->name) ?></h2>
        <?php  ?>
            <p><?= $this->Time->format($airdrop->created_on, 'd MMM, Y') ?></p>
			<?php 
			$total_rating = $airdrop->project_quality+$airdrop->strangeness+$airdrop->different_ico+$airdrop->actual_use+$airdrop->team;
			$average = round($total_rating/5);
			?>
		
       <p><b>Rating</b> &nbsp;&nbsp;<?php 
	   for($i=1;$i<=$average; $i++){
		echo $this->Html->Image('star.png'); 
	   }
	   ?></p>
		<p><?= $airdrop->country ?></p>
		<p><?= $airdrop->Email ?></p>
		 
        <?= $airdrop->link ?>
    </div>
</div>