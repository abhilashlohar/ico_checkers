<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="row my-3 news-body py-3">
    <div class="col-md-12">
        <h2><?= h($airdrop->name) ?></h2>
        <?php if($airdrop->created_on){ ?>
            <p><?= $this->Time->format($airdrop->created_on, 'd MMM, Y') ?> | <?= h($airdrop->country) ?></p>
        <?php } 
		$total_rating = $airdrop->project_quality+$airdrop->strangeness+$airdrop->different_ico+$airdrop->actual_use+$airdrop->team;
		$average = round($total_rating/5);
		?>
		<p>All Over Rating :  <?php for($i=1;$i<=$average; $i++){ ?>
				 	<i class="fa fa-star" aria-hidden="true"></i> 
				  <?php } ?> 
		</p>
		<table class="table">
			<tr>
				<td> Project Quality : </td>
				<td>
				<?php for($i=1;$i<=$airdrop->project_quality; $i++){ ?>
				 	<i class="fa fa-star" aria-hidden="true"></i> 
				<?php } ?> 
				</td>
			</tr>
			<tr>
				<td>Strangeness : </td>
				<td><?php for($i=1;$i<=$airdrop->strangeness; $i++){ ?>
				 	<i class="fa fa-star" aria-hidden="true"></i> 
				  <?php } ?>
				 </td>
			</tr>
			<tr>
				<td>Different ICO : </td>
				<td>
				<?php for($i=1;$i<=$airdrop->different_ico; $i++){ ?>
				 	<i class="fa fa-star" aria-hidden="true"></i> 
				<?php } ?> 
				</td>
			</tr>
			<tr>
				<td>Actual Use : </td>
				<td>
				<?php for($i=1;$i<=$airdrop->actual_use; $i++){ ?>
				 	<i class="fa fa-star" aria-hidden="true"></i> 
				<?php } ?> 
				</td>
			</tr>
			<tr>
				<td>Team : </td>
				<td>
				<?php for($i=1;$i<=$airdrop->team; $i++){ ?>
				 	<i class="fa fa-star" aria-hidden="true"></i> 
				<?php } ?> 
				</td>
			</tr>
		</table>
		
		
		<?= $this->Text->autoParagraph(h($airdrop->description)); ?>
    </div>
</div>