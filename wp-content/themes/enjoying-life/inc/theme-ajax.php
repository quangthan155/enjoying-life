<?php
/*
 * Theme ajax
 *
 * @package enjoying-life
 * @author QUANGTN
 */

function send_contact_inquiry_calback() {
	$option_key       = 'option';
	$option           = get_field( 'email_template', $option_key );
	$inquiry_item     = 'inquiry_item';
	$nursery_item     = 'nursery_item';
	$fullname         = 'fullname';
	$phonenumber      = 'phonenumber';
	$mailaddress      = 'mailaddress';
	$message          = 'message';

	$data = [
		$inquiry_item	=> sanitize_text_field( $_POST[ $inquiry_item ] ),
		$nursery_item   => sanitize_text_field( $_POST[ $nursery_item ] ),
		$fullname       => sanitize_text_field( $_POST[ $fullname ] ),
		$phonenumber    => sanitize_text_field( $_POST[ $phonenumber ] ),
		$mailaddress    => sanitize_email( $_POST[ $mailaddress ] ),
		$message        => sanitize_textarea_field( $_POST[ $message ] )
	];
	
	$passed = validationFields( $data, 'contact-inquiry-form-nonce' );

	if ( $passed && $_SERVER['REQUEST_METHOD'] === 'POST' ) {

		$admin_to_key = 'admin_to';
		$subject_key  = 'subject';
		$content_key  = 'content';
		
		$admin_email  = ! empty( $option[ $admin_to_key ] ) ? $option[ $admin_to_key ] : get_option( 'new_admin_email' );
		$redirect_url = home_url( trim( get_field( 'page_thank', $option_key ) ) );
		$user_email   = $data[ $mailaddress ]; // Mail of user
		
		$send_admin_mail_result = send_mail_inquiry( $admin_email, $data, [
			$subject_key => $option['admin_subject'],
			$content_key => $option['admin_content']
		] );
		
		$send_user_mail_result = send_mail_inquiry( $user_email, $data, [
			$subject_key => $option['user_subject'],
			$content_key => $option['user_content']
		] );
		
		if ( ! $send_admin_mail_result || ! $send_user_mail_result ) {
			// Send mail failed
			wp_send_json_error( [
				$message_key => 'エラー'
			] );
		} else {
			wp_send_json_success( [
				'send_admin_mail_result' => $send_admin_mail_result,
				'send_user_mail_result'  => $send_user_mail_result,
				'redirect_url'           => $redirect_url
			] );
		}
	} else {
		// Bad request
		wp_send_json_error( [
			$message_key => 'この操作が完了できませんでした'
		] );
	}

	die();
}

add_action( 'wp_ajax_send_contact_inquiry', 'send_contact_inquiry_calback' );
add_action( 'wp_ajax_nopriv_send_contact_inquiry', 'send_contact_inquiry_calback' );

/**
 * @param $to
 * @param $dataMail
 * @param array $options
 *
 * @return bool
 */
function send_mail_inquiry( $to, $dataMail, $options = [] ) {
	$content   = $options['content'];
	$date_send = get_date_from_gmt( date( 'Y-m-d H:i:s' ) );
	foreach ( $dataMail as $element_name => $element_data ) {
		$element_data_replace = ! empty( $element_data ) ? $element_data : '-';
		$content              = str_replace( '{$' . $element_name . '}', $element_data_replace, $content );
	}

	$content = str_replace( '{$time}', $date_send, $content );
	$content = str_replace( '{$siteurl}', home_url(), $content );

	return wp_mail( $to, $options['subject'], $content, array( 'Content-Type: text/html; charset=UTF-8' ) );
}

/**
 * @param $data
 * @param $nonce_name
 *
 * @return bool
 */
function validationFields( $data, $nonce_name ) {	
	$security    = check_ajax_referer( $nonce_name, 'nonce', false );
	$inquiry_item_key	= 'inquiry_item';
	$nursery_item_key   = 'nursery_item';
	$fullname_key       = 'fullname';
	$phonenumber_key    = 'phonenumber';
	$mailaddress_key    = 'mailaddress';
	$message_key        = 'message';

	$valitionMaxLength = [
		$inquiry_item_key    => 50,
		$nursery_item_key    => 8,
		$fullname_key        => 50,
		$phonenumber_key     => 11,
		$mailaddress_key     => 50,
		$message_key => 1000
	];
	
	if ( ! $security
		 || empty( $data[ $inquiry_item_key ] ) || ! in_array( $data[ $inquiry_item_key ], INQUIRY_ITEMS )
		 || empty( $data[ $nursery_item_key ] ) || ! in_array( $data[ $nursery_item_key ], NURSERY_ITEMS )
	     || empty( $data[ $fullname_key ] ) || mb_strlen( $data[ $fullname_key ] ) > $valitionMaxLength[ $fullname_key ]
	     || empty( $data[ $phonenumber_key ] ) || mb_strlen( $data[ $phonenumber_key ] ) > $valitionMaxLength[ $phonenumber_key ]
		 || empty( $data[ $mailaddress_key ] ) || mb_strlen( $data[ $mailaddress_key ] ) > $valitionMaxLength[ $mailaddress_key ]
		 || ( ! empty( $data[ $message_key ] ) && mb_strlen( $data[ $message_key ] ) > $valitionMaxLength[ $message_key ] )
	     || ! preg_match( '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $data[ $mailaddress_key ] )
	) {
		return false;
	}

	return true;
}
