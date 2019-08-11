<?php
$this->Html->css(['blog'], ['block' => true]);
?>
<div class="container py-3" style="font-family: 'Nunito', sans-serif;">
	<div class="row mb-2">
		<div class="col-md-12">
		
			<div class="card-columns">
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
			
					if($date > strtotime(date('d-m-Y H:i:s'))){ ?>
			  		<div class="card">
					    <div class="card-body" style="border: solid 1px #00444547;">
					    	<a class="text-dark task_title" href="<?= $this->Url->build(['controller'=>'Tasks','action'=>'taskSubmit',$task->id])?>" style="text-decoration: none;">
					      	<h5 class="card-title" style="color: #F9886;"><?= $task->title ?></h5>
					      </a>
					      <div class="mb-1 text-muted"><?php echo date('d M, Y',strtotime($task->created_on))?> | created by : <?php echo !empty($task->user)?$task->user->name:'' ?></div>
						  	<div class="mb-1 text-muted">Remaining day/time : <?php echo $remaining; ?></div>
						  	<div class="mb-1 " style="color: #EC96A4;">Reward MDI Coin : <b><?php echo $task->minimum_point; ?></b></div>
					      <!-- <div>
							  	<?php
								  echo $this->Text->truncate(
								    $this->Text->autoParagraph($task->description),
								    90,
								    [
								        'ellipsis' => '...',
								        'exact' => false
								    ]
								  );
								  ?>
							  </div><br> -->
							  <a href="<?= $this->Url->build(['controller'=>'Tasks','action'=>'taskSubmit',$task->id])?>" class="btn" style="background-color: #6FB98F; color: #FFF;">Complete Task </a>
					    </div>
					  </div>
			  <?php } 
				}
			} ?>

			</div>

		</div>
	</div>
	<?php if(count($tasks)!=0){?>
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
	<?php } ?>

</div>



<style type="text/css" >
	/* Large devices (desktops, 992px and up) */
	@media (min-width: 992px) { 
		.card-columns {
		  column-count: 2;
		}
	}
</style>