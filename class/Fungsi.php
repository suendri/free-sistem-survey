<?php

/**
 * Gosoftware Media Indonesia
 * --
 * --
 * http://gosoftware.web.id
 * e-mail : cs@gosoftware.web.id
 * WA : 6285263616901
 * --
 * --
 */


class Fungsi {

	public static function encode($string) {

		$id=(double)$string*525325.24;
		return base64_encode($id);
	}

	public static function decode($string) {

		$url_id=base64_decode($string);
		$id=(double)$url_id/525325.24;
		return $id;
	} 

	public static function setSession($key, $value = false) {

		if (is_array($key) && $value === false) {
			foreach ($key as $name => $value) {
				$_SESSION[SESSION_PREFIX . $name] = $value;
			}
		} else {
			$_SESSION[SESSION_PREFIX . $key] = $value;
		}
	}

	public static function getSession($key, $secondkey = false) {

		if ($secondkey == true) {
			if (isset($_SESSION[SESSION_PREFIX . $key][$secondkey])) {
				return $_SESSION[SESSION_PREFIX . $key][$secondkey];
			}
		} else {
			if (isset($_SESSION[SESSION_PREFIX . $key])) {
				return $_SESSION[SESSION_PREFIX . $key];
			}
		}
		return null;
	}

	public static function destroy($key = '', $prefix = false) {

		if ($key == '' && $prefix == false) {
			session_unset();
			session_destroy();
		} elseif ($prefix == true) {
			/** clear all session for set SESSION_PREFIX */
			foreach ($_SESSION as $key => $value) {
				if (strpos($key, SESSION_PREFIX) === 0) {
					unset($_SESSION[$key]);
				}
			}
		} else {
			/** clear specified session key */
			unset($_SESSION[SESSION_PREFIX . $key]);
		}
	} 

	public static function feedback() {

		$feedback_positive = self::getSession('feedback_positive');
		$feedback_negative = self::getSession('feedback_negative');
		$feedback_error = self::getSession('feedback_error');

		if (isset($feedback_positive) && !empty($feedback_positive)) {
			return '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $feedback_positive 
			. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>';
		}

		if (isset($feedback_negative) && !empty($feedback_negative)) {
			return '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $feedback_negative 
			. '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span></button></div>';
		}

		if (isset($feedback_error) && !empty($feedback_error)) {
			return '<div class="alert alert-danger" role="alert">' . $feedback_error . '</div>';
		}
	}

	public static function feedbackDestroy() {
		self::destroy('feedback_positive');
		self::destroy('feedback_negative');
		self::destroy('feedback_error'); 
	}

	public static function  tanggalStrip($tgl){
		$tanggal  =  substr($tgl,8,2);
		$bulan  =  substr($tgl,5,2);
		$tahun  =  substr($tgl,0,4);
		return  $tanggal.'-'.$bulan.'-'.$tahun;
	}

	public static function  tanggalSpasi($tgl){
		$tanggal  =  substr($tgl,8,2);
		$bulan  =  getBulan(substr($tgl,5,2));
		$tahun  =  substr($tgl,0,4);
		return  $tanggal.' '.$bulan.' '.$tahun;
	}
}