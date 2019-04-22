<div class="row py-3">
    <div class="col-md-12">
        <h2><?= h($airdrop->name) ?></h2>
        <?php if($airdrop->created_on){ ?>
            <p><?= h($airdrop->created_on->format("d M Y h:i A")) ?></p>
        <?php } ?>
		<p><?= $airdrop->country ?></p>,
		<p><?= $airdrop->Email ?></p>
		 
        <?= $airdrop->link ?>
    </div>
</div>