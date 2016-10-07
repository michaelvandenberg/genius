jQuery(document).ready(function($) {

	/**
	 *	Process request to dismiss our admin notice
	 */
	$('#jetpack-notice .notice-dismiss').click(function() {

		//* Data to make available via the $_POST variable
		data = {
			action: 'genius_jetpack_admin_notice',
			genius_jetpack_admin_nonce: genius_jetpack_admin.genius_jetpack_admin_nonce
		};

		//* Process the AJAX POST request
		$.post( ajaxurl, data );

		return false;
	});
});