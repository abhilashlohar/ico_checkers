<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="py-2">
	<div class="alert alert-danger alert-dismissible fade show ">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Error!</strong> <?= $message ?>
	</div>
</div>
