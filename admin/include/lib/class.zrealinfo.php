<?php
/**
 * 认证信息操作
 * 
 */
class zRealInfo {
	
	private $dbh = NULL;
	
	public function __construct() {
		$this->dbh = $GLOBALS ['z_dbh'];
	}
	
	public function add($schoolid, $name, $idcard, $email) {
		global $table_prefix;
		$schoolid = trim($schoolid);
		$name = trim($name);
		$idcard = trim($idcard);
		$email = trim($email);
		if($this->isExistEmail($email) || $this->isExistSchoolid($schoolid))
			return FALSE;
		try {
			$sth = $this->dbh->prepare ( "INSERT INTO {$table_prefix}realinfo(`schoolid`,`name`,`idcard`,`email`) VALUES( :schoolid, :name, :idcard, :email)" );
			$sth->bindParam ( ':schoolid', $schoolid);
			$sth->bindParam ( ':name',  $name);
			$sth->bindParam ( ':idcard', $idcard);
			$sth->bindParam ( ':email', $email);
			$sth->execute ();
			if (! ($sth->rowCount () > 0)) {
				return FALSE;
			}
			return $this->dbh->lastInsertId ();
		} catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
	
	public function isExistID($id) {
		$id = intval ( $id );
		global $table_prefix;
		try {
			$sth = $this->dbh->prepare ( "SELECT count(*) FROM {$table_prefix}realinfo WHERE `id` = :id " );
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
	
	public function isExistSchoolid($schoolid) {
		$schoolid = trim($schoolid);
		global $table_prefix;
		try {
			$sth = $this->dbh->prepare ( "SELECT count(*) FROM {$table_prefix}realinfo WHERE `schoolid` = :schoolid " );
			$sth->bindParam ( ':schoolid', $schoolid );
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
			$sth = $this->dbh->prepare ( "SELECT count(*) FROM {$table_prefix}realinfo WHERE `email` = :email " );
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
	
	public function getDetail($id) {
		global $table_prefix;
		$id = intval ( $id );
		if (! $this->isExistID ( $id )) {
			return FALSE;
		}
		try {
			$sth = $this->dbh->prepare ( "SELECT * FROM {$table_prefix}realinfo WHERE `id` = :id " );
			$sth->bindParam ( ':id', $id );
			$sth->execute ();
			$result = $sth->fetch ( PDO::FETCH_ASSOC );
			return $result;
		} catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
	
	public function update($id, $schoolid, $name, $idcard, $email) {
		global $table_prefix;
		$schoolid = trim($schoolid);
		$name = trim($name);
		$idcard = trim($idcard);
		$email = trim($email);
		
		if (! $this->isExistID ( $id )) {
			return FALSE;
		}
		try {
			$sth = $this->dbh->prepare ( "UPDATE {$table_prefix}realinfo SET `schoolid`= :schoolid, `name`= :name, `idcard`= :idcard, `email`= :email WHERE `id` = :id" );
			$sth->bindParam ( ':schoolid', $schoolid);
			$sth->bindParam ( ':name',  $name);
			$sth->bindParam ( ':idcard', $idcard);
			$sth->bindParam ( ':email', $email);
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
	
	public function del($id) {
		global $table_prefix;
		$id = intval ( $id );
		if (! $this->isExistID ( $id )) {
			return FALSE;
		}
		try {
			$sth = $this->dbh->prepare ( "DELETE FROM {$table_prefix}realinfo WHERE `id` = :id " );
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
}