<div class="card mt-3">
  <div class="card-body">
		<div class="mb-5"><h4>News Preview</h4></div>
		<h2><?= h($news->title) ?></h2>
		<div align="center">
			<?php
				if ($news->cover_image) {
					echo $this->Html->image(str_replace('\\','/',@$news->cover_image),['class'=>'img-thumbnail','style'=>'max-height:400px;']);
					echo '<br>';
				};
			?>
		</div>
		<?= $this->Text->autoParagraph(h($news->description)); ?>

		<table>
			<tr>
				<th>Status:</th>
				<td><?= h($news->status) ?></td>
			</tr>
			<tr>
				<th>Category:</th>
				<td><?= h($news->category) ?></td>
			</tr>
			<tr>
				<th>Tags:</th>
				<td><?= h($news->tags) ?></td>
			</tr>
		</table>
  </div>
</div>
