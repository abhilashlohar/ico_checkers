<?php
$this->Html->css(['blog'], ['block' => true]);
?>
<div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
         
        </div>
      </header>

		<div class="row mb-2">
			<?php if(!empty($airdrops)){
			foreach($airdrops as $airdrop){
			?>
			<div class="col-md-12">
			  <div class="card flex-md-row mb-4 box-shadow h-md-250">
				<div class="card-body d-flex flex-column align-items-start">
				  <h3 class="mb-0">
					<a class="text-dark" href="<?= $this->Url->build(['controller'=>'Airdrops','action'=>'view/'.$airdrop->id])?>"><?= $airdrop->name ?></a>
				  </h3>
				  <div class="mb-1 text-muted"><?php echo date('d M, Y',strtotime($airdrop->created_on))?></div>
				  <p class="card-text mb-auto"><?= $airdrop->short_description ?></p>
				  <a href="<?= $this->Url->build(['controller'=>'Airdrops','action'=>'view/'.$airdrop->id])?>">Continue reading</a>
				</div>
			  </div>
			</div>
			<?php }} ?>
		</div>
    </div>