<?php
$this->Html->css(['blog'], ['block' => true]);
?>
<div class="container">
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
				  <h3 class="mb-0">
					<a class="text-dark" href="<?= $this->Url->build(['controller'=>'Tasks','action'=>'taskSubmit',$task->id])?>"><?= $task->title ?></a>
				  </h3>
				  <div class="mb-1 text-muted"><?php echo date('d M, Y',strtotime($task->created_on))?></div>
				  <div class="mb-1 text-muted">Remaining day/time : <?php echo $remaining; ?></div>
				  <p class="card-text mb-auto"><?= $this->Text->autoParagraph(h($task->description)) ?></p>
				  <a href="<?= $this->Url->build(['controller'=>'Tasks','action'=>'taskSubmit',$task->id])?>" class="btn ic_button">Submit Task ></a>
				</div>
				
			  </div>
			</div>
			<?php } }} ?>
		</div>
    </div>