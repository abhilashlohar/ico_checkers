<div class="row py-5">
    <div class="col-md-12">
        <h3>Your referral code is <span><?= $referral_code ?></span></h3>
        <h3>Your referral link</h3>
        
        <input type="text" class="form-control form-control-lg col-8" value="http://localhost/ico_checkers/sign-up?ref=<?= $referral_code ?>" id="myInput">
        <button onclick="myFunction()" class="btn ic_button">Copy referral link</button>
                
        
        
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