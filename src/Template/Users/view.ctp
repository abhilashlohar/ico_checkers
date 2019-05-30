<div class="container">
  <h2><?= $user->name ?></h2>
           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Photo</th>
        <td>
		 <?= $this->Html->Image(($user->photo!='')?str_replace('\\','/',$user->photo):'//placehold.it/100',['class'=>'avatar img-circle','alt'=>$user->name,'width'=>'125','height'=>'125']);?>
		</td>
      </tr>
    </thead>
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