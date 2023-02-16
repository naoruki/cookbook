$(function () {
	$("#login-form-link").click(function (e) {
		$("#login-form").delay(100).fadeIn(100);
		$("#register-form").fadeOut(100);
		$("#register-form-link").removeClass("active");
		$(this).addClass("active");
		e.preventDefault();
	});
	$("#register-form-link").click(function (e) {
		$("#register-form").delay(100).fadeIn(100);
		$("#login-form").fadeOut(100);
		$("#login-form-link").removeClass("active");
		$(this).addClass("active");
		e.preventDefault();
	});
});
$(document).ready(function () {
	$("#recipeTable").DataTable();
});
$(document).ready(function () {
	$("#recipeCategoryTable").DataTable();
});
$(document).ready(function () {
	$("#favouriteTable").DataTable();
});
function loginForm() {
	var email = $("#email").val();
	var password = $("#password").val();

	$.ajax({
		type: "POST",
		url: "login_form.php",
		dataType: "json",
		data: {
			email: email,
			password: password,
		},
		success: function (data) {
			if (data.code == "200") {
				Swal.fire({
					title: "Login",
					text: data.msg,
					icon: "success",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				}).then(function () {
					window.location = window.location.href;
				});
			} else if (data.code == "100") {
				Swal.fire({
					title: "Register",
					text: data.msg,
					icon: "warning",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				});
			} else if (data.code == "300") {
				Swal.fire({
					title: "Register",
					text: data.msg,
					icon: "warning",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				});
			} else {
				$(".display-error").html("<ul>" + data.msg + "</ul>");
				$(".display-error").css("display", "block");
			}
		},
	});
}
// ajax for registering
function registerForm() {
	var name = $("#name").val();
	var registerEmail = $("#registerEmail").val();
	var registerPassword = $("#registerPassword").val();
	var confirmPassword = $("#confirmPassword").val();
	var agree = $("input:checkbox:checked").val();

	$.ajax({
		type: "POST",
		url: "register_form.php",
		dataType: "json",
		data: {
			name: name,
			registerEmail: registerEmail,
			registerPassword: registerPassword,
			confirmPassword: confirmPassword,
			agree: agree,
		},
		success: function (data) {
			if (data.code == "100") {
				$(".register-error").css("display", "none");
				//Check user exists
				Swal.fire({
					title: "Register",
					text: data.msg,
					icon: "warning",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				});
			} else if (data.code == "200") {
				//User Successfully registered
				Swal.fire({
					title: "Register",
					text: data.msg,
					icon: "success",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				}).then(function () {
					window.location = window.location.href;
				});
			} else {
				$(".register-error").html("<ul>" + data.msg + "</ul>");
				$(".register-error").css("display", "block");
				$(".register-success").css("display", "none");
			}
		},
	});
}
//Ajax for updating recipe details
function updateRecipe(recipeID) {
	var name = $("#name" + recipeID).val();
	var ingredient = $("#ingredient" + recipeID).val();
	var recipeID = $("#recipeID" + recipeID).val();
	var category = $("#category" + recipeID).val();
	$.ajax({
		type: "POST",
		url: "update_recipe.php",
		dataType: "json",
		data: {
			name: name,
			ingredient: ingredient,
			recipeID: recipeID,
			category: category,
		},
		success: function (data) {
			if (data.code == "200") {
				Swal.fire({
					title: "Update Recipe",
					text: data.msg,
					icon: "success",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				}).then(function () {
					window.location = window.location.href;
				});
			} else if (data.code == "100") {
				Swal.fire({
					title: "Update Recipe",
					text: data.msg,
					icon: "warning",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				});
			} else {
				$(".display-error" + recipeID).html("<ul>" + data.msg + "</ul>");
				$(".display-error" + recipeID).css("display", "block");
			}
		},
	});
}

//Log out with sweet alert message
function logout(url) {
	Swal.fire({
		title: "Logging out",
		text: "You will be logged out",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, Logout!",
	}).then((result) => {
		if (result.isConfirmed) {
			Swal.fire("Log out!", "You have successfully logged out", "success");
			window.location = url;
		}
	});
}
//Ajax to add favourite
function addFavourite(recipeID) {
	var recipeID = $("#recipeID" + recipeID).val();
	var userID = $("#userID" + recipeID).val();
	$.ajax({
		type: "POST",
		url: "add_favourite.php",
		dataType: "json",
		data: {
			recipeID: recipeID,
			userID: userID,
		},
		success: function (data) {
			if (data.code == "200") {
				$(".fav-icon" + recipeID).removeClass("fa-regular fa-heart");
				$(".fav-icon" + recipeID).addClass("fa-solid fa-heart");
				Swal.fire({
					title: "add Favourite",
					text: data.msg,
					icon: "success",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				}).then(function () {
					window.location.reload();
				});
			} else {
				Swal.fire({
					title: "add Favourite",
					text: data.msg,
					icon: "warning",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				});
			}
		},
	});
}
//Ajax to remove favourite from recipe page
function removeFavourite(recipeID) {
	var recipeID = $("#recipeID" + recipeID).val();
	var userID = $("#userID" + recipeID).val();
	$.ajax({
		type: "POST",
		url: "remove_favourite.php",
		dataType: "json",
		data: {
			recipeID: recipeID,
			userID: userID,
		},
		success: function (data) {
			if (data.code == "200") {
				$(".unfav-icon" + recipeID).removeClass("fa-solid fa-heart");
				$(".unfav-icon" + recipeID).addClass("fa-regular fa-heart");
				Swal.fire({
					title: "Remove Favourite",
					text: data.msg,
					icon: "success",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				}).then(function () {
					window.location.reload();
				});
			} else {
				Swal.fire({
					title: "Remove Favourite",
					text: data.msg,
					icon: "warning",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				});
			}
		},
	});
}
//Ajax to remove favourite from profile list
function removeFavouriteFromList(recipeID) {
	var recipeID = $("#recipeID" + recipeID).val();
	var userID = $("#userID" + recipeID).val();
	$.ajax({
		type: "POST",
		url: "remove_favourite.php",
		dataType: "json",
		data: {
			recipeID: recipeID,
			userID: userID,
		},
		success: function (data) {
			if (data.code == "200") {
				$(".unfav-icon" + recipeID).removeClass("fa-solid fa-heart");
				$(".unfav-icon" + recipeID).addClass("fa-regular fa-heart");
				$(".favList" + recipeID).fadeOut(1000);
				Swal.fire({
					title: "Remove Favourite",
					text: data.msg,
					icon: "success",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				});
			} else {
				Swal.fire({
					title: "Remove Favourite",
					text: data.msg,
					icon: "warning",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				});
			}
		},
	});
}
//reset password in profile
function changePassword() {
	var userID = $("#userID").val();
	var oldPassword = $("#oldPassword").val();
	var newPassword = $("#newPassword").val();
	var confirmPassword = $("#confirmPassword").val();
	$.ajax({
		type: "POST",
		url: "update_password.php",
		dataType: "json",
		data: {
			oldPassword: oldPassword,
			newPassword: newPassword,
			confirmPassword: confirmPassword,
			userID: userID,
		},
		success: function (data) {
			if (data.code == "200") {
				Swal.fire({
					title: "Update Password",
					text: data.msg,
					icon: "success",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				}).then(function () {
					window.location.reload();
				});
			} else if (data.code == "300") {
				Swal.fire({
					title: "Wrong password",
					text: data.msg,
					icon: "warning",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				}).then(function () {
					window.location.reload();
				});
			} else {
				$(".display-error").html("<ul>" + data.msg + "</ul>");
				$(".display-error").css("display", "block");
			}
		},
	});
}
//Ajax to delete Recipe
function deleteRecipe(recipeID) {
	var recipeID = $("#recipeID" + recipeID).val();
	var userID = $("#userID" + recipeID).val();
	$.ajax({
		type: "POST",
		url: "delete_recipe.php",
		dataType: "json",
		data: {
			recipeID: recipeID,
			userID: userID,
		},
		success: function (data) {
			if (data.code == "200") {
				Swal.fire({
					title: "Deleted Favourite",
					text: data.msg,
					icon: "success",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				}).then(function () {
					window.location.reload();
				});
			} else {
				Swal.fire({
					title: "Deleted Favourite",
					text: data.msg,
					icon: "warning",
					timer: 5000,
					customClass: {
						confirmButton: "btn btn-primary",
					},
					buttonsStyling: false,
				});
			}
		},
	});
}
