<?php
$this->Html->css(['blog'], ['block' => true]);
?>
<div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
         
        </div>
      </header>

		<div class="row mb-2">
			<?php if(!empty($news)){
			foreach($news as $news1){
			?>
			<div class="col-md-12">
			  <div class="card flex-md-row mb-4 box-shadow h-md-250">
				<div class="card-body d-flex flex-column align-items-start">
				  <h3 class="mb-0">
					<a class="text-dark" href="<?= $this->Url->build(['controller'=>'News','action'=>'view/'.$news1->id])?>"><?= $news1->title ?></a>
				  </h3>
				  <div class="mb-1 text-muted"><?php echo date('d M, Y',strtotime($news1->created_on))?></div>
				  <p class="card-text mb-auto"><?= $news1->short_description ?></p>
				  <a href="<?= $this->Url->build(['controller'=>'News','action'=>'view/'.$news1->id])?>">Continue reading</a>
				</div>
				<?php echo $this->html->image(str_replace("\\","/",$news1->cover_image),['class'=>'card-img-right flex-auto  d-md-blocks','height'=>125,'width'=>125]);?>
			  </div>
			</div>
			<?php }} ?>
		</div>
    </div>