<?php
class User {
	
	private $userId = null;
	private $userName = null;
	private $userRealName = null;
	private $isAdmin = false;
	
	function __construct( $id ) {
		$userId = $id;
	}
	
	
	public function newFromId( $id ) {
		return new User( $id );
	}
	
	public function isAdmin() {
		return $isAdmin;
	}
}