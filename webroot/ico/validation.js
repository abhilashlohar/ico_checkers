
$("#inquiry").submit(function (event) {
	if(validate(this)!= false) {
		$(".imgloader").css("display", "block");
		var name = document.inquiry.name.value;
		var email = document.inquiry.email.value;
		var reason = document.inquiry.reason.value;
		var message = document.inquiry.message.value;
		/* $.ajax({
			method: 'GET',
			url:window.location.origin+'/enquiries/callback',
			datatype: 'html',
			data:{
				name:name,
				email:email,
				reason:reason,
				message:message
			},
			cache:false,
			beforeSend: function(){
			}
		}).done(function(data){ 
		    $('#msg').html(data);
		    $('.valid_error').html('');
			$(".imgloader").css("display", "none");
			$('input ,textarea, select').val('');
		}); */
		//return false;
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

$("#subscribe").submit(function (event) {
	if(subscribe_validate(this)!= false) {
		$("#loader").css("display", "block");
		var email = document.subscribe.subscribe_email.value;
		
		$.ajax({
			method: 'GET',
			url:window.location.origin+'/enquiries/subscribe',
			datatype: 'html',
			data:{
				email:email
			},
			cache:false,
			beforeSend: function(){
			}
		}).done(function(data){ 
		    $('#msg1').html(data);
		    $('.valid_error').html('');
			$("#loader").css("display", "none");
			$('input').val('');
		});
		return false;
	}
    else {
		$("#loader").css("display", "none");
		return false;
    }	
	
});
function subscribe_validate(theform) {
	var testresult;
    if (document.subscribe.subscribe_email.value == "") {
        $(".valid_error[data-valmsg-for='subscribe_email']").text("Please Enter Email");
        $(".valid_error[data-valmsg-for='subscribe_email']").parent().addClass("has-error");
        
        document.subscribe.subscribe_email.focus();
        return false;
    }
    else {
        var string = document.subscribe.subscribe_email.value;
        var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
        if (filter.test(string)) {
            testresult = true;
            
            $(".valid_error[data-valmsg-for='subscribe_email']").text("✔");
            $(".valid_error[data-valmsg-for='subscribe_email']").parent().removeClass("has-error").addClass("has-success");
        }
        else {
            $(".valid_error[data-valmsg-for='subscribe_email']").text("Please Enter Valid Email");
            $(".valid_error[data-valmsg-for='subscribe_email']").parent().addClass("has-error");
            
            document.subscribe.subscribe_email.value = "";
            document.subscribe.subscribe_email.focus();
            return false;
        }
    }
}