<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="row my-3 news-body py-3" style="border: solid 1px #f9886638;">
  <div class="col-md-12">
    <h2 style="color: #F98866;"><?= h($airdrop->name) ?></h2>
      
    <?php if($airdrop->created_on){ ?>
    	<p><?= $this->Time->format($airdrop->created_on, 'd MMM, Y') ?> | <?= h($airdrop->country) ?></p>
    <?php } 
			$total_rating = $airdrop->project_quality+$airdrop->strongness+$airdrop->different_ico+$airdrop->actual_use+$airdrop->team;
			$average = round($total_rating/5);
		?>
	
		<p>
			Over All  Rating : 
			<?php for($i=1;$i<=10; $i++){
 				if ($i<=$average) {
					echo '<i class="fa fa-star" aria-hidden="true" style="color: #FF420E;"></i> ';
 				} else {
					echo '<i class="fa fa-star" aria-hidden="true"></i> ';
 				}
			} ?>
		</p>

		<div>
			<span><b>Description:</b></span><br>
			<?= $this->Text->autoParagraph($airdrop->description) ?>
		</div>

		<div>
			<span><b>Website: </b></span>
			<span><?= $airdrop->link ?></span>
		</div>

		<div>
			<span><b>CEO/Founder Email: </b></span>
			<span><?= $airdrop->email ?></span>
		</div>
		
		<br>
		<table class="table">
			<tr>
				<td colspan="2" style="text-align: center;"><h6>Our ratings on various parameters</h6></td>
			</tr>
			<tr>
				<td><b>Project Quality:</b> </td>
				<td>
					<?php for($i=1;$i<=10; $i++){
	   				if ($i<=$airdrop->project_quality) {
							echo '<i class="fa fa-star" aria-hidden="true" style="color: #FF420E;"></i> ';
	   				} else {
							echo '<i class="fa fa-star" aria-hidden="true"></i> ';
	   				}
					} ?>
				</td>
			</tr>
			<tr>
				<td><b>strongness:</b></td>
				<td>
					<?php for($i=1;$i<=10; $i++){
	   				if ($i<=$airdrop->strongness) {
							echo '<i class="fa fa-star" aria-hidden="true" style="color: #FF420E;"></i> ';
	   				} else {
							echo '<i class="fa fa-star" aria-hidden="true"></i> ';
	   				}
					} ?>
				</td>
			</tr>
			<tr>
				<td><b>Different ICO:</b></td>
				<td>
					<?php for($i=1;$i<=10; $i++){
	   				if ($i<=$airdrop->different_ico) {
							echo '<i class="fa fa-star" aria-hidden="true" style="color: #FF420E;"></i> ';
	   				} else {
							echo '<i class="fa fa-star" aria-hidden="true"></i> ';
	   				}
					} ?>
				</td>
			</tr>
			<tr>
				<td><b>Actual Use:</b></td>
				<td>
					<?php for($i=1;$i<=10; $i++){
	   				if ($i<=$airdrop->actual_use) {
							echo '<i class="fa fa-star" aria-hidden="true" style="color: #FF420E;"></i> ';
	   				} else {
							echo '<i class="fa fa-star" aria-hidden="true"></i> ';
	   				}
					} ?>
				</td>
			</tr>
			<tr>
				<td><b>Team:</b></td>
				<td>
					<?php for($i=1;$i<=10; $i++){
	   				if ($i<=$airdrop->team) {
							echo '<i class="fa fa-star" aria-hidden="true" style="color: #FF420E;"></i> ';
	   				} else {
							echo '<i class="fa fa-star" aria-hidden="true"></i> ';
	   				}
					} ?>
				</td>
			</tr>
		</table>
		
		
		<div>
			<span><b>Our Comment:</b></span><br>
			<?= $this->Text->autoParagraph($airdrop->comment) ?>
		</div>

  </div>
</div>