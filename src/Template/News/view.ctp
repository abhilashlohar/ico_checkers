<div class="row py-3">
    <div class="col-md-12">
        <h2><?= h($news->title) ?></h2>
        <?php if($news->published_on){ ?>
            <p><?= h($news->published_on->format("d M Y h:i A")) ?> | <?= h($news->category) ?></p>
        <?php }else{
            echo "<p>(<i>Pending for approval</i>)</p>";
        }


		 if($news->cover_image!=''){ 
        echo $this->Html->image(str_replace('\\','/',@$news->cover_image),['class'=>'img-thumbnail','width'=>'100%']);
        echo '<br><br>';
        };
		 ?>
        <?= $this->Text->autoParagraph(h($news->description)); ?>
    </div>
</div>
