<?php
$this->Html->css(['blog'], ['block' => true]);
?>
<div class="container" style="font-family: 'Nunito', sans-serif;">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
         
        </div>
      </header>

		<div class="row mb-2">
			<?php if(!empty($tasks)){
			foreach($tasks as $task){
				$date = strtotime($task->created_on);
				$date = strtotime("+".$task->end_days." day", $date);
				$date_now = strtotime(date('d-m-Y H:i:s'));
				$Datediff     = abs($date - $date_now);
				$years   =   floor($Datediff / (365*60*60*24));
				$months  =   floor(($Datediff - $years * 365*60*60*24) / (30*60*60*24));
				$days    =   floor(($Datediff- $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
				$hours   = floor(($Datediff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                $minutes = floor(($Datediff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
                $seconds = floor(($Datediff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60)); 
                $remaining = $days.' day '.$hours.' hours '.$minutes.' min ';	
			if(date('d-m-Y H:i:s',$date) > date('d-m-Y H:i:s')){
			?>
			<div class="col-md-12">
			  <div class="card flex-md-row mb-4 box-shadow h-md-250">
				<div class="card-body d-flex flex-column align-items-start">
				  <h1 class="mb-0 task_title">
						<a class="text-dark task_title" href="<?= $this->Url->build(['controller'=>'Tasks','action'=>'taskSubmit',$task->id])?>">
							<?= $task->title ?>
						</a>
				  </h1>
				  <div class="mb-1 text-muted"><?php echo date('d M, Y',strtotime($task->created_on))?></div>
				  <div class="mb-1 text-muted">Remaining day/time : <?php echo $remaining; ?></div>
				  <div>
				  	<?php
					  echo $this->Text->truncate(
					    $this->Text->autoParagraph($task->description),
					    120,
					    [
					        'ellipsis' => '...',
					        'exact' => false
					    ]
					  );
					  ?>
				  </div>
				  <a href="<?= $this->Url->build(['controller'=>'Tasks','action'=>'taskSubmit',$task->id])?>" class="btn btn-primary">Complete Task </a>
				</div>
				
			  </div>
			</div>
			<?php } }} ?>

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