<?php
/**
 * app操作
 * 
 */
class zApp {
	
	private $dbh = NULL;
	
	public function __construct() {
		$this->dbh = $GLOBALS ['z_dbh'];
	}
	
	public function add($name, $trust) {
		global $table_prefix;
		$name = trim($name);
		$trust = intval($trust);
		$key = get_salt(100);
		$seckey = get_salt(100);
		try {
			$sth = $this->dbh->prepare ( "INSERT INTO {$table_prefix}apps(`name`,`key`,`seckey`,`trust`) VALUES( :name, :key, :seckey, :trust)" );
			$sth->bindParam ( ':name', $name);
			$sth->bindParam ( ':key',  $key);
			$sth->bindParam ( ':seckey', $seckey);
			$sth->bindParam ( ':trust', $trust);
			$sth->execute ();
			if (! ($sth->rowCount () > 0)) {
				return FALSE;
			}
			return $this->dbh->lastInsertId ();
		} catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
	
	public function isExistSID($sid) {
		global $table_prefix;
		$sid = trim($sid);
		try {
			$sth = $this->dbh->prepare ( "SELECT count(*) FROM {$table_prefix}apps WHERE `sid` = :sid" );
			$sth->bindParam ( ':sid', $sid );
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
	
	public function isExistID($id) {
		$id = intval ( $id );
		global $table_prefix;
		try {
			$sth = $this->dbh->prepare ( "SELECT count(*) FROM {$table_prefix}apps WHERE `id` = :id " );
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
	
	public function getDetail($id) {
		global $table_prefix;
		$id = intval ( $id );
		if (! $this->isExistID ( $id )) {
			return FALSE;
		}
		try {
			$sth = $this->dbh->prepare ( "SELECT * FROM {$table_prefix}apps WHERE `id` = :id " );
			$sth->bindParam ( ':id', $id );
			$sth->execute ();
			$result = $sth->fetch ( PDO::FETCH_ASSOC );
			return $result;
		} catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
	
	/*
	 * 更新应用key,seckey 
	 */
	public function refresh($id) {
		global $table_prefix;
		$id = intval ( $id );
		$key = get_salt(100);
		$seckey = get_salt(100);
		if (! $this->isExistID ( $id )) {
			return FALSE;
		}
		try {
			$sth = $this->dbh->prepare ( "UPDATE {$table_prefix}apps SET `key`= :key, `seckey`= :seckey WHERE `id` = :id" );
			$sth->bindParam ( ':key', $key );
			$sth->bindParam ( ':seckey', $seckey );
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
	
	public function update($name, $trust, $id) {
		global $table_prefix;
		$id = intval ( $id );
		$name = trim($name);
		$trust = intval($trust);
		if (! $this->isExistID ( $id )) {
			return FALSE;
		}
		try {
			$sth = $this->dbh->prepare ( "UPDATE {$table_prefix}apps SET `name`= :name, `trust`= :trust WHERE `id` = :id" );
			$sth->bindParam ( ':name', $name );
			$sth->bindParam ( ':trust', $trust );
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
	
	public function updateTrust($value, $id) {
		global $table_prefix;
		$value = intval($value);
		$id = intval ( $id );
		if (! $this->isExistID ( $id )) {
			return FALSE;
		}
		try {
			$sth = $this->dbh->prepare ( "UPDATE {$table_prefix}apps SET `trust`= :trust WHERE `id` = :id" );
			$sth->bindParam ( ':trust', $value );
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
			$sth = $this->dbh->prepare ( "DELETE FROM {$table_prefix}apps WHERE `id` = :id " );
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