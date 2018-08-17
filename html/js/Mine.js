$(function() {
	$('#btn_login').click(function() {        
		username = $('#username').val();
		password = $('#password').val();
		var str = 'username=' + username + '&password=' + password;
		var dir_login = "/classes/";
		$.ajax({            
			url: dir_login + 'login.php?' + str,
			success: function(resp) {											
				if (resp == 'false') {
					//alert('Login failed: Incorrect username or password!');
					$.notify("Login failed: Incorrect username or password!");
				} 
				else 
					//window.location.replace("profile.php?username=" + username);						
					window.location.replace("/user/" + username);						
			}
		});
		return false;
	});
});

$(function() {
	$("form#logOut").submit (function () {		
		var formData = new FormData(this);
		$.ajax({					
			type: "POST",
			url: "/classes/LogOut.php?action=logout",
			data: formData,
			async: false,
			success: function () {
				//$.notify("See you again!", "success");
				window.location.reload(true);
			},			
			cache: false,
			contentType: false,
			processData: false,
		});
	});
});

$(function() {
	$("form#add_pro_form").submit (function () {
		var mes = "Add this problem? (y/n)";
		var Commit = prompt(mes);
		if (Commit == 'y') {
			var formData = new FormData(this);
			$.ajax({					
				type: "POST",
				url: "/classes/session_add_pro.php",					
				data: formData,
				async: false,
				success: function(resp) {
					var $data = $(resp);
					var message = $data.filter('#resp').html();
					alert(message);
				},
				cache: false,
				contentType: false,
				processData: false,
			});	
		};
	});
});

$(function() {
	$("form#reset_form").submit (function () {	
		var formData = new FormData(this);
		$.ajax({					
			type: "POST",
			url: "/classes/reset_pass.php",
			data: formData,
			async: false,
			success: function(resp) {
				var $data = $(resp);
				var message = $data.filter('#resp').html();
				$.notify(message, "info");
			},
			cache: false,
			contentType: false,
			processData: false,
		});
	});
});

$(function() {
	$("form#delete_pro").submit (function () {
		var mes = "Delete this problems? (y/n)";
		var Commit = prompt(mes);
		if (Commit == 'y') {
			var formData = new FormData(this);
			$.ajax({					
				type: "POST",
				url: "/classes/delete_problem.php",
				data: formData,
				async: false,
				success: function(resp) {					
					var $data = $(resp);
					var message = $data.filter('#resp').html();
					alert(message, "info");								
				},
				cache: false,
				contentType: false,
				processData: false,
			});
		} else {
			window.location.reload(true);
		};
	});
});

$(function() {
	$("#search_but").click (function () {							
		var input = $('#tags').val();
		if (input != "") {
			input = "/" + input;
			var url = "/problems" + input + "/page/1/";
			window.location.href = url;
			return false;
		}
	});
});

$(function() {
	$("form#change_pass").submit (function () {			
		var formData = new FormData(this);
		$.ajax({					
			type: "POST",
			url: "/classes/process_change_password.php",
			data: formData,
			async: false,
			success: function(resp) {
				var $data = $(resp);
				var message = $data.filter('#resp').html();
				//alert(message);
				$.notify(message, "info");
			},
			cache: false,
			contentType: false,
			processData: false,
		});
	});
});

$(function() {
	$("form#reg_form").submit(function () {		
		var formData = new FormData(this);
		$.ajax({
			type: "POST",
			url: "/classes/session_register.php",
			data: formData,
			async: false,
			success: function(resp) {
				var $data = $(resp);
				var message = $data.filter('#resp').html();
				$.notify(message, "info");
			},
			cache: false,
			contentType: false,
			processData: false,
		});
	});
});

$(function() {
	$("form#edit_problem_form").submit (function () {
		var formData = new FormData(this);
		$.ajax({					
			type: "POST",
			url: "/classes/edit_problem.php",					
			data: formData,
			async: false,
			success: function(resp) {
				var $data = $(resp);
				var message = $data.filter('#resp').html();
				alert(message);
			},
			cache: false,
			contentType: false,
			processData: false,
		});				
	});
});
$(function() {
	$("form#edit_admin_form").submit (function () {
		var formData = new FormData(this);
		$.ajax({					
			type: "POST",
			url: "/classes/edit_admin.php",					
			data: formData,
			async: false,
			success: function(resp) {
				var $data = $(resp);
				var message = $data.filter('#resp').html();
				alert(message);
			},
			cache: false,
			contentType: false,
			processData: false,
		});				
	});
});
