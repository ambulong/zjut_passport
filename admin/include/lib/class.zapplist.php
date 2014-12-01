<?php
/**
 * app列表
*
*/
class zAppList {

	private $dbh = NULL;

	public function __construct() {
		$this->dbh = $GLOBALS ['z_dbh'];
	}
	
	public function getList($offset = 0, $rows = 0) {
		global $table_prefix;
		$offset = intval($offset);
		$rows = intval($rows);
		try {
			$sth = $this->dbh->prepare ( "SELECT * FROM {$table_prefix}apps LIMIT {$offset},{$row}" );
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