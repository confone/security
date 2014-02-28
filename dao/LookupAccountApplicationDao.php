<?php
class LookupAccountApplicationDao extends SecurityDao {

	const ACCOUNTID = 'account_id';
	const APPLICATIONID = 'application_id';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'confone_lookup_application';
	const TABLE = 'account_application';

// ============================================ override functions ==================================================

	public static function getApplicationIdsByAccountId($accountId) {
		$lookup = new LookupAccountApplicationDao();
		$lookup->setServerAddress($accountId);

		$sql = "SELECT ".LookupAccountApplicationDao::APPLICATIONID." FROM ".LookupAccountApplicationDao::TABLE." WHERE "
				.LookupAccountApplicationDao::ACCOUNTID."=$accountId";

		$connect = DBUtil::getConn($lookup);
		$res = DBUtil::selectDataList($connect, $sql);

		if ($res) {
			return $res[LookupAccountApplicationDao::APPLICATIONID];
		} else {
			return 0;
		}
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupAccountApplicationDao::IDCOLUMN] = 0;
		$this->var[LookupAccountApplicationDao::ACCOUNTID] = 0;
		$this->var[LookupAccountApplicationDao::APPLICATIONID] = 0;
	}

	protected function beforeInsert() {
		$sequence = $this->var[AccountDao::ACCOUNTID];
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupAccountApplicationDao::SHARDDOMAIN;
	}

	public function getTableName() {
		return LookupAccountApplicationDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupAccountApplicationDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>