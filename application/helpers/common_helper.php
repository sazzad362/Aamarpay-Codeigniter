<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
	/**
	 * @param     $array
	 * @param int $exit
	 */
	function pre($array, $exit = 1) {
		echo '<pre>';
		print_r($array);
		echo '</pre>';
		if ($exit == 1) {
			exit;
		}
	}
	
	/**
	 * @param     $array
	 * @param int $exit
	 */
	function var_pre($array, $exit = 1) {
		echo '<pre>';
		var_dump($array);
		echo '</pre>';
		if ($exit == 1) {
			exit;
		}
	}
	
	function show_query() {
		$CI = &get_instance();
		echo $CI->db->last_query();
		exit;
	}
	