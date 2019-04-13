<div class="row py-5">
  <div class="col-md-6">
    <div class="card flex-md-row mb-4 box-shadow h-md-250">
      <div class="card-body d-flex flex-column align-items-start">
        <h3 class="mb-0">
        Your referral code is <span><?= $referral_code ?></span>
        </h3>
      </div>
    </div>

    <h3>Your referral link</h3>
    <input type="text" class="form-control form-control-lg col-12" value="http://localhost/ico_checkers/sign-up?ref=<?= $referral_code ?>" id="myInput">
    <button onclick="myFunction()" class="btn ic_button">Copy referral link</button>
  </div>

  <div class="col-md-6">
    <?php echo $this->Html->Image('/img/refer.jpg',['style'=>'width:100%']); ?>
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