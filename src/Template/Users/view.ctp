<div class="container mt-5">
  <h2 class="float-left">
  <?= $this->Html->Image(($user->photo!='')?str_replace('\\','/',$user->photo):'//placehold.it/100',['class'=>'avatar img-circle','alt'=>$user->name,'width'=>'70','height'=>'70']);?>
  <?= $user->name ?>
  </h2>

  <?= $this->Html->link('Add/Remove Coins', ['controller' => 'MdiCoins', 'action' => 'addCoins', $user->id],['class'=>'btn btn-primary float-right']) ?>

  <table class="table table-bordered">
    <tbody>
	  <tr>
        <th>Date of Birth</th>
        <td><?= $this->Time->format($user->dob, 'dd MMMM, yyyy') ?></td>
      </tr>
      <tr>
        <th>email</th>
        <td><?= $user->email ?></td>
      </tr>
      <tr>
        <th>Mobile</th>
        <td><?= $user->mobile ?></td>
      </tr>
      <tr>
        <th>Role</th>
        <td><?= $user->role ?></td>
      </tr>
	  <tr>
        <th>Registration Date</th>
        <td><?= $this->Time->format($user->created, 'dd MMMM, yyyy') ?></td>
      </tr>
	  <tr>
        <th>Wallet Balance</th>
        <td><?= $point ?></td>
      </tr>
    </tbody>
  </table>
</div>