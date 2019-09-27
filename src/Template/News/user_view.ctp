<div class="row my-3 news-body py-3">
    <div class="col-md-12">
        <h2><?= h($news->title) ?></h2>
        <p><?= h($news->published_on->format("d M Y h:i A")) ?> | <?= h($news->category) ?></p>
        <?php echo $news->description; ?>
    </div>
</div>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<div class="addthis_inline_share_toolbox"></div>

<?php if ($user_id) { ?>
  <?= $this->Form->create($comment,['url'=>'saveComment']) ?>
  <div class="row my-3" style="background-color: #efefef; border-radius: 5px; padding: 5px 10px;">
    <?php echo $this->Form->control('news_id',['value'=>$news_id,'type'=>'hidden']); ?>
    <div class="col-md-9  mb-2">
      <?php echo $this->Form->control('comment',['class'=>'form-control','type'=>'textarea', 'rows'=>3]); ?>
    </div>
    <div class="col-md-6 mb-2">
      <?php echo $this->Form->control('backlink',['class'=>'form-control','type'=>'text']); ?>
      <small>Your website/post link for which you want to create a backlink on this page</small>
    </div>
    <div class="col-md-6 mb-2">
      <?php echo $this->Form->control('user_website',['class'=>'form-control','type'=>'text']); ?>
      <small>Your website/post link where you will create a backlink for us.</small>
    </div>
    <div class="col-md-6 mb-2">
      <button type="submit">Save</button>
    </div>
  </div>
  <?= $this->Form->end() ?>
<?php } else { ?>
<div>
  <br/><a href="https://icocheckers.com/sign-in" class="btn btn-primary">Login to comment</a>
</div>
<?php } ?>

<div class="row my-2">
  <?php foreach ($comments as $comment): ?>
    <div class="col-md-12 my-2 p-3" style="background-color: #FFF;border-radius: 5px; border: 1px solid #e8e8e8;">
      <?php $backlink = ($comment->backlink) ? $comment->backlink : "https://icocheckers.com"; ?>
      <a href="<?php echo $backlink; ?>" target="_blank"><?= $comment->user->name ?></a><br/>
      <div><?= $comment->comment ?></div>


    </div>
  <?php endforeach ?>
</div>




