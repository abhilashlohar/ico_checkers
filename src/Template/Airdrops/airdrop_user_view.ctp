<?php
$this->Html->css(['blog'], ['block' => true]);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container py-3">

	<div class="row mb-2">
		<div class="col-md-12">
			
			<div class="card-columns">
				<?php if(!empty($airdrops)){
					foreach($airdrops as $airdrop){
						$average = 0;
						$total_rating = $airdrop->project_quality+$airdrop->strongness+$airdrop->different_ico+$airdrop->actual_use+$airdrop->team;
						$average = round($total_rating/5); ?>

						<div class="card">
					    <div class="card-body" style="border: solid 1px #f9886638;">
					    	<a class="text-dark task_title" href="<?= $this->Url->build('/airdrop-view/'.$airdrop->id)?>" style="text-decoration: none;">
					      	<h5 class="card-title" style="color: #F98866;"><?= $airdrop->name ?></h5>
					      </a>
					      <div class="mb-1 text-muted">
					      	<div>
						      	<span> Country: <?= $airdrop->country ?> </span>
					      	</div>
					      	<div>
						      	<span> 
						      		Rating:
						     			<?php for($i=1;$i<=10; $i++){
						     				if ($i<=$average) {
													echo '<i class="fa fa-star" aria-hidden="true" style="color: #FF420E;"></i> ';
						     				} else {
													echo '<i class="fa fa-star" aria-hidden="true"></i> ';
						     				}
				  						} ?>
						      	</span>
					      	</div>

							  <a href="<?= $this->Url->build('/airdrop-view/'.$airdrop->id)?>" class="btn mt-2" style="background-color: #F98866; color: #FFF;">Continue reading</a>
					    </div>
					  </div>

					<?php }
				} ?>
			</div>

		</div>
	</div>

	<div class="col-md-12 d-flex justify-content-center">
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


<style type="text/css" >
	/* Large devices (desktops, 992px and up) */
	@media (min-width: 992px) { 
		.card-columns {
		  column-count: 2;
		}
	}
</style>