<?php
/**
 * 管理员操作类
 * @author Ambulong
 *
 */
class zAdmin {
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
			$sth = $this->dbh->prepare ( "SELECT * FROM {$table_prefix}admin WHERE `username` = :username" );
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
		
		if(!$this->isExistName($username))
			return FALSE;
		
		//md5
		if(strlen($hash) == 32){
			if(strcmp(md5($password), $hash) == 0){
				$this->update($password);
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		//phpass
		if ($this->hasher->CheckPassword ( $password, $hash ))
			return TRUE;
		else
			return FALSE;
	}
	
	public function update($username, $password) {
		global $table_prefix;
		$username = strtolower(trim($username));
		$hash = $this->hasher->HashPassword ( $password );
		if(!$this->isExistName($username))
			return FALSE;
		try {
			$sth = $this->dbh->prepare ( "UPDATE {$table_prefix}admin SET `password`= :password WHERE `username` = :username" );
			$sth->bindParam ( ':password', $hash );
			$sth->bindParam ( ':username', $username );
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
			$sth = $this->dbh->prepare ( "SELECT count(*) FROM {$table_prefix}admin WHERE `username` = :name " );
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