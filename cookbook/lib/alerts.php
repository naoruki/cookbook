<?php

####### Default JS Alert Popup #######

//------ Alert Popup & Redirect After
function alertRedirect($message, $redirectURL){
	echo "<script language='JavaScript'>window.alert('$message');window.location='$redirectURL'</script>";
}

//------ Alert Popup & Redirect Using JS Replace
function alertReplace($message, $redirectURL){
	echo "<script language='JavaScript'>window.alert('$message');window.location.replace('$redirectURL')</script>";
}

//------ Alert Popup & Reload Page After
function alertReload($message){
	echo "<script language='JavaScript'>window.alert('$message'); window.location=window.location.href;</script>";
}

//------ Normal Alert Popup
function alertWindow($message){
	echo "<script language='JavaScript'>window.alert('" . $message . "')</script>";
}


####### SweetAlert JS Popup #######
# Note: Include SweetAlert CDN for this to work
# https://sweetalert2.github.io/#download

# $title: Title for your popup
# $msg: Message for your popup
# $type: Popup icon options - "error" (Red), "success" (Green), "info" (Blue), "warning" (Yellow)
# $duration: How long should the popup stay open? (in ms) 1000 = 1 second
# $url: Where to be redirected to?

//------ SweetAlert Popup With Confirmation Button
function sweetAlert($type, $title, $msg, $duration){
	echo "<script>Swal.fire({
			title: '$title',
			text: '$msg',
			icon: '$type',
			timer: $duration,
			customClass: {
				confirmButton: 'btn btn-primary'
			},
			buttonsStyling: false
		});</script>";
}

//------ SweetAlert Popup With Confirm Button & Reload Page After
function sweetAlertReload($type, $title, $msg, $duration){
	echo "<script>Swal.fire({
			title: '$title',
			text: '$msg',
			icon: '$type',
			timer: $duration,
			customClass: {
				confirmButton: 'btn btn-primary'
			},
			buttonsStyling: false
		}).then(function() {
			window.location = window.location.href;
		});</script>";
}

//------ SweetAlert Popup With Confirm Button & Redirect After
function sweetAlertRedirect($type, $title, $msg, $duration, $url){
	echo "<script>Swal.fire({
			title: '$title',
			text: '$msg',
			icon: '$type',
			timer: $duration,
			customClass: {
				confirmButton: 'btn btn-primary'
			},
			buttonsStyling: false
		}).then(function() {
			window.location = '$url';
		});</script>";
}


####### SweetAlert JS Popup #######
# Note: Include ToastrAlert CDN for this to work
# https://codeseven.github.io/toastr/

# $title: Title for your popup
# $msg: Message for your popup
# $type: Popup icon options - "error" (Red), "success" (Green), "info" (Blue), "warning" (Yellow)
# $duration: How long should the popup stay open? (in ms) 1000 = 1 second

//------ ToastrAlert Popup
function toastrAlert($type, $title, $msg, $duration){
	echo "<script>toastr.$type(
			'$msg',
			'$title',
			{
				timeOut: $duration,
				closeButton: true,
				tapToDismiss: false
			}
		);</script>";
}

?>