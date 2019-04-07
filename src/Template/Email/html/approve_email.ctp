<?php
$URL = $this->Url->build(['controller' => 'Users', 'action' => 'approveemail', $str], true);
?>
<p>
    Hi <?= $name ?>,<br /><br />
    
    Approved your Email id. Click on below link<br />
	<?= $this->Html->link($URL, $URL) ?>
   
    