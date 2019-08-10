<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="py-2" onclick="this.classList.add('hidden')"><div class="alert alert-success alert-dismissible fade show">
		<strong>Success!</strong> <?= $message ?>
	</div>
</div>
