<?php if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

class ApiAuth {
	public function login($username, $password) {
		if($username == 'guest' && $password == 'pG_8746!') {
			return true;
		} else {
			return false;
		}
	}
}