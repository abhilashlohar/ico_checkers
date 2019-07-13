<?php
$this->Html->css(['blog'], ['block' => true]);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
         
        </div>
      </header>

		<div class="row mb-2">
			<?php if(!empty($airdrops)){
			foreach($airdrops as $airdrop){
			$average = 0;
			$total_rating = $airdrop->project_quality+$airdrop->strangeness+$airdrop->different_ico+$airdrop->actual_use+$airdrop->team;
			$average = round($total_rating/5);
			
			?>
			<div class="col-md-12">
			  <div class="card flex-md-row mb-4 box-shadow h-md-250">
				<div class="card-body d-flex flex-column align-items-start">
				  <h3 class="mb-0">
					<a class="text-dark" href="<?= $this->Url->build('/airdrop-view/'.$airdrop->id)?>"><?= $airdrop->name ?></a>
				  </h3>
				  <p><?= $airdrop->country ?>
				  <?php if($average!=0){ ?>
				  <br>
				  Rating &nbsp;&nbsp;<?php 
				   for($i=1;$i<=$average; $i++){ ?>
					<i class="fa fa-star" aria-hidden="true"></i> 
				  <?php } }
				   ?>
				   </p>
				  <div class="mb-1 text-muted"><?php echo date('d M, Y',strtotime($airdrop->created_on))?></div>
				  <p class="card-text mb-auto">
					<?php 
					if(strlen($airdrop->description)>310)
					{
						echo substr($airdrop->description,0,310).'...';
					}
					else{
						echo $airdrop->description;
					}
					?>
				  </p>
				  
				  <a href="<?= $this->Url->build('/airdrop-view/'.$airdrop->id)?>">Continue reading</a>
				</div>
			  </div>
			</div>
			<?php }} ?>
		</div>
    </div>