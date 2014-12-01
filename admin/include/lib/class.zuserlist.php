<?php
/**
 * 用户列表
*
*/
class zUserList {

	private $dbh = NULL;

	public function __construct() {
		$this->dbh = $GLOBALS ['z_dbh'];
	}
	
	public function getList($offset = 0, $rows = 0) {
		global $table_prefix;
		$offset = intval($offset);
		$rows = intval($rows);
		try {
			if($offset == 0 && $rows == 0)
				$sth = $this->dbh->prepare ( "SELECT * FROM {$table_prefix}users" );
			else
				$sth = $this->dbh->prepare ( "SELECT * FROM {$table_prefix}users LIMIT {$offset},{$row}" );
			$sth->execute ();
			$result = $sth->fetchAll ( PDO::FETCH_ASSOC );
			if (count ( $result ) <= 0) {
				$result = array ();
			}
			return $result;
		}catch ( PDOExecption $e ) {
			echo "<br>Error: " . $e->getMessage ();
		}
	}
}