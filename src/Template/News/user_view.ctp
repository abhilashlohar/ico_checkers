<div class="row my-3 news-body py-3">
    <div class="col-md-12">
        <h2><?= h($news->title) ?></h2>
        <?php if($news->published_on){ ?>
            <p><?= h($news->published_on->format("d M Y h:i A")) ?> | <?= h($news->category) ?></p>
        <?php }else{
            echo "<p>(<i>Pending for approval</i>)</p>";
        }
		if($news->cover_image!=''){ 
            echo '<div align="center">'.$this->Html->image(str_replace('\\','/',@$news->cover_image),['class'=>'img-thumbnail','height'=>400,'width'=>400]);echo '</div><br/>';
        };
		
		 ?>
        <?= $this->Text->autoParagraph(h($news->description)); ?>
    </div>
</div>
<?php echo $this->fetch('postLink'); ?>
<?=
$this->Html->scriptBlock(" 
var id = ".@$user_id."; 
var news_id = ".@$news->id."; 
setInterval(function() { 
	$.ajax({
        method: 'GET',
        url: '".$this->Url->build(['controller' => 'News','action' => 'savePoint'])."',
        dataType: 'html',
        data:{
				user_id:id,
				news_id:news_id,
			},
        cache: false,
        beforeSend: function() { 
            //$('#ajax-indicator').fadeIn();
			
        }
    }).done(function(data) { 
       
       // $('.requestform_error').html(data);
        
    }).always(function() {
       
    });
	return false;
}, 1000 * 60 * 3);
	 
", ['block' => true]); ?>

