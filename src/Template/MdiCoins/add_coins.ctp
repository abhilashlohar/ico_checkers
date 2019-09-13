<div class="card my-3">
  <div class="card-header">
    Add or Remove MDI Coins from <b><?= $user->name ?>'s</b> wallet
  </div>
  <div class="card-body">
    <h5>Wallet Balance: <?= $wallet_balance ?></h5>
    <br>

    <?= $this->Form->create($mdiCoin) ?>
      <?php echo $this->Form->control('wallet_action',['options'=>['ADD'=>'ADD','REMOVE'=>'REMOVE'], 'class'=>'form-control', 'style'=>'width:200px;', 'label'=>false, 'type'=>'select']); ?>
      <br>
      <?php echo $this->Form->control('coins',['class'=>'form-control', 'style'=>'width:200px;']); ?>
      <br>
      <?php echo $this->Form->control('reason',['class'=>'form-control', 'style'=>'width:400px;', 'type'=>'textarea', 'required']); ?>
      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
    <?= $this->Form->end() ?>
  </div>
</div>