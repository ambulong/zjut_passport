<?php
/**
 * 管理员操作类
 * @author Ambulong
 *
 */
class zUser {
	private $dbh = NULL;
	private $hasher = NULL;
	
	public function __construct() {
		$this->dbh = $GLOBALS ['z_dbh'];
		$this->hasher = new PasswordHash ( 8, FALSE );
	}
	
	public function __destruct() {
		if (isset ( $this->hasher ))
			unset ( $this->hasher );
	}
	
	public function getPassword($username) {
		global $table_prefix;
		$username = strtolower(trim($username));
		try {
			$sth = $this->dbh->prepare ( "SELECT * FROM {$table_prefix}admins WHERE `username` = :username" );
			$sth->bindParam ( ':username', $username );
			$sth->execute ();
			$result = $sth->fetch ( PDO::FETCH_ASSOC );
			if(isset($result["password"]))
				return $result["password"];
			return "";
		} catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
	
	public function auth($username, $password) {
		$username = strtolower(trim($username));
		$hash = $this->getPassword($username);
		if ($this->hasher->CheckPassword ( $password, $hash ))
			return TRUE;
		else
			return FALSE;
	}
	
	public function update($password) {
		global $table_prefix;
		$hash = $this->hasher->HashPassword ( $password );
		try {
			$sth = $this->dbh->prepare ( "UPDATE {$table_prefix}admins SET `password`= :password WHERE 1" );
			$sth->bindParam ( ':password', $hash );
			$sth->execute ();
			if (! ($sth->rowCount () > 0))
				return FALSE;
			else
				return TRUE;
		} catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
	
	/**
	 * 用户名是否存在
	 *
	 * @param String $name
	 *        	要查询的用户名
	 * @return boolean
	 */
	public function isExistName($name) {
		global $table_prefix;
		$name = strtolower(trim($name));
		try {
			$sth = $this->dbh->prepare ( "SELECT count(*) FROM {$table_prefix}admins WHERE `username` = :name " );
			$sth->bindParam ( ':name', $name );
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