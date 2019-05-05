<?php
$URL = $this->Url->build(['controller' => 'Users', 'action' => 'resetPassword', $passwordToken], true);
?>
<p>
    Hi <?= $userInfo->name ?>,<br /><br />
    
    Changing your password. Please click the link below.<br />
    <?= $this->Html->link($URL, $URL) ?><br /><br />
    
    This email is valid till <strong><?= $this->Time->format($tokenExpiry, 'EEEE, dd MMMM yyyy hh:mm a') ?></strong>
</p><br />
