
$("#inquiry").submit(function (event) {
	if(validate(this)!= false) {
		$(".imgloader").css("display", "block");
		return false;
	}
    else {
		$(".imgloader").css("display", "none");
		return false;
    }	
	
});
function validate(theform) {
	if (document.inquiry.name.value == "") {

        $(".valid_error[data-valmsg-for='name']").text("Please Enter Name");
        $(".valid_error[data-valmsg-for='name']").parent().addClass("has-error");

        document.inquiry.name.focus();
        return false;
    }
    else {
        $(".valid_error[data-valmsg-for='name']").text("✔");
        $(".valid_error[data-valmsg-for='name']").parent().removeClass("has-error").addClass("has-success");
    }
	
	
	
	var testresult;
    if (document.inquiry.email.value == "") {
        $(".valid_error[data-valmsg-for='email']").text("Please Enter Email");
        $(".valid_error[data-valmsg-for='email']").parent().addClass("has-error");
        
        document.inquiry.email.focus();
        return false;
    }
    else {
        var string = document.inquiry.email.value;
        var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
        if (filter.test(string)) {
            testresult = true;
            
            $(".valid_error[data-valmsg-for='email']").text("✔");
            $(".valid_error[data-valmsg-for='email']").parent().removeClass("has-error").addClass("has-success");
        }
        else {
            $(".valid_error[data-valmsg-for='email']").text("Please Enter Valid Email");
            $(".valid_error[data-valmsg-for='email']").parent().addClass("has-error");
            
            document.inquiry.email.value = "";
            document.inquiry.email.focus();
            return false;
        }
    }
}