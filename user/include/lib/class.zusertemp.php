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
	
	public function getIDByEmail($email) {
		global $table_prefix;
		$email = trim($email);
		if (! $this->isExistEmail($email)) {
			return FALSE;
		}
		try {
			$sth = $this->dbh->prepare ( "SELECT * FROM {$table_prefix}users_temp WHERE `email` = :email " );
			$sth->bindParam ( ':email', $email );
			$sth->execute ();
			$result = $sth->fetch ( PDO::FETCH_ASSOC );
			return $result['id'];
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
			$sth->bindParam ( ':id', $id );
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
			$sth->bindParam ( ':id', $id );
			$sth->execute ();
			$result = $sth->fetch ( PDO::FETCH_ASSOC );
			return $result['time'];
		} catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
	
	public function genVerifyToken($id) {
		global $table_prefix;
		$id = intval ( $id );
		$verify_token = json_encode(array("0", get_salt(100)));
		$time = get_time();
		if (! $this->isExistID ( $id )) {
			return FALSE;
		}
		try {
			$sth = $this->dbh->prepare ( "UPDATE {$table_prefix}users_temp SET `verify_token`= :verify_token, `time`= :time WHERE `id` = :id" );
			$sth->bindParam ( ':verify_token', $verify_token);
			$sth->bindParam ( ':time',  $time);
			$sth->bindParam ( ':id', $id );
			$sth->execute ();
			if (! ($sth->rowCount () > 0))
				return FALSE;
			else
				return TRUE;
		} catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
	
	/*
	 * 更新token，需要校验token {"0", "xxx"}
	 * 
	 * @param $token string 用来校验的token
	 * @param $type 更新否的token类型 |1(实名认证)|2(删除用户)
	 * 
	 * @return boolean
	 */
	 public function updateVerifyToken($token, $type, $id) {
		global $table_prefix;
		$id = intval ( $id );
		$type = intval($type);
		$token = trim($token);
		if($type != 1 && $type != 2)
			return FALSE;
		$verify_token = json_encode(array("{$type}", get_salt(100)));
		$check_token = json_encode(array("0", "{$token}"));
		$time = get_time();
		if (! $this->isExistID ( $id )) {
			return FALSE;
		}
		try {
			$sth = $this->dbh->prepare ( "UPDATE {$table_prefix}users_temp SET `verify_token`= :verify_token, `time`= :time WHERE `id` = :id AND `verify_token` = :check_token" );
			$sth->bindParam ( ':verify_token', $verify_token);
			$sth->bindParam ( ':time',  $time);
			$sth->bindParam ( ':id', $id );
			$sth->bindParam ( ':check_token', $check_token );
			$sth->execute ();
			if (! ($sth->rowCount () > 0))
				return FALSE;
			else
				return TRUE;
		} catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
	
	public function del($id) {
		global $table_prefix;
		$id = intval ( $id );
		if (! $this->isExistID ( $id )) {
			return FALSE;
		}
		try {
			$sth = $this->dbh->prepare ( "DELETE FROM {$table_prefix}users_temp WHERE `id` = :id " );
			$sth->bindParam ( ':id', $id );
			$sth->execute ();
			$row = $sth->rowCount ();
			if ($row > 0) {
				return $row;
			} else {
				return FALSE;
			}
		} catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
	
	public function validateVerifyToken($email, $token, $type) {
		$email = trim($email);
		$token = trim($token);
		$type = intval($type);
		if($type != 1 && $type != 2)
			return FALSE;
		$check_token = json_encode(array("{$type}", "{$token}"));
		global $table_prefix;
		try {
			$sth = $this->dbh->prepare ( "SELECT count(*) FROM {$table_prefix}users_temp WHERE `email` = :email AND `verify_token` = :check_token" );
			$sth->bindParam ( ':email', $email );
			$sth->bindParam ( ':check_token', $check_token );
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
	
	public function validateVerifyTime($id) {
		global $table_prefix;
		$id = intval ( $id );
		if (! $this->isExistID ( $id )) {
			return FALSE;
		}
		try {
			$sth = $this->dbh->prepare ( "SELECT count(*) FROM {$table_prefix}users_temp WHERE `id` = :id AND ABS(UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(`lastestRequest`)) > 300" );
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
}