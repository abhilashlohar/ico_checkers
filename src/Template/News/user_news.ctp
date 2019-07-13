<?php
$this->Html->css(['blog'], ['block' => true]);
?>
<div class="container" style="font-family: 'Nunito', sans-serif;">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
     
    </div>
  </header>

	<div class="row mb-2">
		<?php if(!empty($news)){
		foreach($news as $news1){ ?>
			<div class="col-md-12">
			  <div class="card flex-md-row mb-4 box-shadow h-md-250">
				<div class="card-body d-flex flex-column align-items-start">
				  <h1 class="mb-0 news_title">
					<a class="text-dark" href="<?= $this->Url->build('/user-view/'.$news1->id)?>"><?= $news1->title ?></a>
				  </h1>
				  <div class="mb-1 text-muted"><?php echo date('d M, Y',strtotime($news1->created_on))?></div>
				  <div>
				  	<?php
						  echo $this->Text->truncate(
						    $this->Text->autoParagraph($news1->description),
						    250,
						    [
						        'ellipsis' => '.....',
						        'exact' => false
						    ]
						  );
						?>
				  </div>
				  <a href="<?= $this->Url->build('/user-view/'.$news1->id)?>">Continue reading</a>
				</div>
				<?php echo $this->Html->image(str_replace("\\","/",$news1->cover_image),['class'=>'card-img-right flex-auto  d-md-blocks','height'=>125]);?>
			  </div>
			</div>
		<?php } } ?>

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
</div>