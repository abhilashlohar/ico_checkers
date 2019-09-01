<div class="card mt-3">
  <div class="card-body">
		<div class="mb-5"><h4><span class="badge badge-light">News and Articles Preview</span></h4></div>
		<h2><?= h($news->title) ?></h2>

    <table class="table">
      <tr>
        <td><p><?= h($news->cover_description) ?></p></td>
        <td>
          <?php
            if ($news->cover_image) {
              echo $this->Html->image(str_replace('\\','/',@$news->cover_image),['class'=>'img-thumbnail','style'=>'max-height:300px;']);
              echo '<br>';
            };
          ?>
        </td>
      </tr>
    </table>
    <br>
		<?php echo $news->description; ?>

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
