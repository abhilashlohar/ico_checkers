<div class="row py-5">
  <div class="col-md-6">
    <?php echo $this->Html->Image('/img/refer.jpg',['style'=>'width:100%']); ?>
  </div>
  
  <div class="col-md-6">
    <div class="card flex-md-row mb-4 box-shadow h-md-250">
      <div class="card-body d-flex flex-column align-items-start">
        <h3 class="mb-0">
        Your referral code is <span><?= $referral_code ?></span>
        </h3>
      </div>
    </div>

    <h3>Your referral link</h3>
    <input type="text" class="form-control form-control-lg col-12" value="https://icocheckers.com/sign-up?ref=<?= $referral_code ?>" id="myInput">
    <button onclick="myFunction()" class="btn btn-primary custom-btn">Copy referral link</button>


    <div class="card my-3">
      <div class="card-header">
        Your Wallet Information
      </div>
      <div class="card-body">
        <h5 class="card-title">You wallet balance: <?= $wallet_balance ?></h5>
        <a href="<?= $this->Url->Build('/My-Wallet')?>" class="btn btn-primary">Go To Wallet</a>
      </div>
    </div>

  </div>
</div>



<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  document.execCommand("copy");
  alert("Copied your referral link: " + copyText.value);
}
</script>