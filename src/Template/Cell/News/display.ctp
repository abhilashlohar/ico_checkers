<?php if($news){ ?>
<div class="row">
	<div class="col">

		<div class="news-carousel owl-carousel">
			<?php foreach ($news as $row) { ?>
				<a data-aos="fade-up" href="<?= $this->Url->Build('/News-and-Articles/'.$row->id.'/'.str_replace(' ', '-', $row->title))?>" class="news-carousel__item" target="_blank">
					<div class="news-carousel__item-body">
						<!-- <div class="news-carousel__item-subtitle">Cryptocurrency</div> -->
						<h3 class="news-carousel__item-title">
							<?= $row->title ?>
						</h3>
						<p>
							<?= $row->cover_description	?>
						</p>
						<div class="news-carousel__item-data">
							<?php echo date('M, d Y',strtotime($row->created_on))?>
						</div>
					</div>
				</a>
			<?php } ?>
		</div>
		
	</div>
</div>
<?php } ?>