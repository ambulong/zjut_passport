<?php
/**
 * 用户邮件token操作
 * 
 */
class zRealInfo {
	
	private $dbh = NULL;
	
	public function __construct() {
		$this->dbh = $GLOBALS ['z_dbh'];
	}
	
	public function isExistID($id) {
		$id = intval ( $id );
		global $table_prefix;
		try {
			$sth = $this->dbh->prepare ( "SELECT count(*) FROM {$table_prefix}users_temp WHERE `id` = :id " );
			$sth->bindParam ( ':id', $id );
			$sth->execute ();
			$row = $sth->fetch ();
			if ($row [0] > 0) {
				return TRUE;
			} else {
				return FALSE;
			}
		} catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
	
	public function isExistEmail($email) {
		$email = trim($email);
		global $table_prefix;
		try {
			$sth = $this->dbh->prepare ( "SELECT count(*) FROM {$table_prefix}users_temp WHERE `email` = :email " );
			$sth->bindParam ( ':email', $email );
			$sth->execute ();
			$row = $sth->fetch ();
			if ($row [0] > 0) {
				return TRUE;
			} else {
				return FALSE;
			}
		} catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
	
	public function getVerifyToken($id) {
		global $table_prefix;
		$id = intval ( $id );
		if (! $this->isExistID ( $id )) {
			return FALSE;
		}
		try {
			$sth = $this->dbh->prepare ( "SELECT * FROM {$table_prefix}users_temp WHERE `id` = :id " );
			$sth->bindParam ( ':id', $value );
			$sth->execute ();
			$result = $sth->fetch ( PDO::FETCH_ASSOC );
			$verify_token = $result['verify_token'];
			if(is_json($verify_token)){
				$verify_token = json_decode($verify_token, true);
			}else{
				$verify_token = array("","");
			}
			return $verify_token;
		} catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
	
	public function getVerifyTime($id) {
		global $table_prefix;
		$id = intval ( $id );
		if (! $this->isExistID ( $id )) {
			return FALSE;
		}
		try {
			$sth = $this->dbh->prepare ( "SELECT * FROM {$table_prefix}users_temp WHERE `id` = :id " );
			$sth->bindParam ( ':id', $value );
			$sth->execute ();
			$result = $sth->fetch ( PDO::FETCH_ASSOC );
			return $result['time'];
		} catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
}