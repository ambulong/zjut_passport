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
	
	public function isExistName($name) {
		$name = trim($name);
		global $table_prefix;
		try {
			$sth = $this->dbh->prepare ( "SELECT count(*) FROM {$table_prefix}realinfo WHERE `name` = :name " );
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
	
	public function validate($email, $name, $schoolid) {
		$email = trim($email);
		$name = trim($name);
		$schoolid = trim($schoolid);
		global $table_prefix;
		try {
			$sth = $this->dbh->prepare ( "SELECT count(*) FROM {$table_prefix}realinfo WHERE `email` = :email AND `name` = :name AND `schoolid` = :schoolid " );
			$sth->bindParam ( ':email', $email );
			$sth->bindParam ( ':name', $name );
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
	
	public function getDetail($id) {
		global $table_prefix;
		$id = intval ( $id );
		if (! $this->isExistID ( $id )) {
			return FALSE;
		}
		try {
			$sth = $this->dbh->prepare ( "SELECT * FROM {$table_prefix}realinfo WHERE `id` = :id " );
			$sth->bindParam ( ':id', $value );
			$sth->execute ();
			$result = $sth->fetch ( PDO::FETCH_ASSOC );
			return $result;
		} catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
	
}