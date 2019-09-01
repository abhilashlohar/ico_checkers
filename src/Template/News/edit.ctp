<div class="row py-3">
  <div class="col-md-12">
		<h4 class="mt-2 float-left">Edit News and Articles</h4>
  </div>
</div>
<div class="row">
	<div class="col-md-12">
		<?= $this->Form->create($news,['type'=>'file']) ?>
			<div class="row">
				<div class="col-md-6 mb-3">
						<div class="form-group">
								<?php echo $this->Form->control('title',['class'=>'form-control']); ?>
						</div>
				</div>
				<div class="col-md-3">
						<div class="form-group">
							<?php echo $this->Form->control('category',['options'=>['India'=>'India','Foreign'=>'Foreign'], 'class'=>'form-control']); ?>
						</div>
				</div>
			</div>
      <div class="row  mb-3">
        <div class="col-md-9">
          <?php echo $this->Form->control('cover_description',['class'=>'form-control']); ?>
        </div>
        <div class="col-md-3">
            <div class="form-group">
              <?php
                if ($news->cover_image!='') {
                  echo $this->Html->image(str_replace('\\','/',@$news->cover_image),['class'=>'img-thumbnail','style'=>'max-height:200px;']);
                  echo '<br>';
                };
                echo $this->Form->control('cover_image',['class'=>'form-control-file','type'=>'file']);
              ?>
            </div>
        </div>
      </div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
							<?php echo $this->Form->control('description',['class'=>'form-control', 'id' => 'summernote', 'type'=>'textarea', 'label'=>'Description', 'rows'=>12]); ?>
              <?php $this->Form->unlockField('files'); ?>
					</div>
				</div>
			</div>
			<div class="row">
					<div class="col-md-9">
							<div class="form-group">
									<?php echo $this->Form->control('tags',['class'=>'form-control', 'type'=>'textarea']); ?>
									<small id="tagsHelp" class="form-text text-muted">e.g.: tag1, tag2, tag3</small>
							</div>
					</div>

					<?php if ($user_role=='Admin'){ ?>
						<div class="col-md-3">
								<div class="form-group">
										<?php echo $this->Form->control('status',[
											'options'=>['Pending for approval'=>'Pending','Rejected'=>'Reject','Approved'=>'Approve'], 
											'class'=>'form-control'
										]); ?>
								</div>
						</div>
					<?php } ?>
					
			</div>
      <div align="center" class="mb-3"><button type="submit" class="btn btn-primary btn-lg">Updates News and Articles</button></div>
			<?= $this->Form->end() ?>
	</div>
</div>

<?php echo $this->Html->css('http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css', ['block' => 'pageLevelJS']); ?>
<?php echo $this->Html->script('http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js', ['block' => 'pageLevelJS']); ?>

<?php
$token = $this->request->getParam('_csrfToken');
setcookie("csrfToken", $token, time() + (86400 * 30), "/");
$JAVASCRIPT = '
$(document).ready(function() {
  $("#summernote").summernote({
    callbacks: {
      onImageUpload: function(files) {
        if (files.length>1) {
          alert("Multiple image not allowed.");
          return;
        }

        if (files[0].size>2097152) {
          alert("Try to upload file less than 2MB!");
          return;
        }

        var fileName = files[0].name;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){}else{
          alert("Only jpg/jpeg and png files are allowed!");
          return;
        }   

        data = new FormData();
        data.append("image", files[0]);
        $.ajax({
            data: data,
            enctype: "multipart/form-data",
            headers: {
                "X-CSRF-TOKEN":"'.$token.'",
            },
            type: "POST",
            url: "http://localhost/ico_checkers/test.php",
            cache: false,
            contentType: false,
            processData: false,
            success: function(imagesURL) {
              var imgNode = $("<img>").attr("src",imagesURL);
              $("#summernote").summernote("insertNode", imgNode[0]);
            }
        });
      }
    }
  });
});
';
echo $this->Html->scriptBlock($JAVASCRIPT, array('block' => 'scriptBottom')); 
?>