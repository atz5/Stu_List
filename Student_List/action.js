
$(document).ready(function(){
		$('#login').click(function(){
			var name=$('#username').val();
			var pass=$('#password').val();
			var rem=$('#remember_me');
			if (name=="" || pass=="") {
				$('#result').html('Either username or password field is empty.');
			}else{
				$.ajax({
					type:'post',
					url:'action.php',
					data:{username:name,password:pass},
					cache:false,
					success:function(result){
						$('#result').html(result);
							
					}
				})
			}
			return false;

		})
	})

$(function() {

    if (localStorage.chkbx && localStorage.chkbx != '') {
        $('#remember_me').attr('checked', 'checked');
        $('#username').val(localStorage.usrname);
        $('#password').val(localStorage.pass);
    } else {
        $('#remember_me').removeAttr('checked');
        $('#loginEmail').val('');
        $('#loginPW').val('');
    }

    $('#remember_me').click(function() {

        if ($('#remember_me').is(':checked')) {
            // save username and password
            localStorage.usrname = $('#username').val();
            localStorage.pass = $('#password').val();
            localStorage.chkbx = $('#remember_me').val();
        } else {
            localStorage.usrname = '';
            localStorage.pass = '';
            localStorage.chkbx = '';
        }
    });
});