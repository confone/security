<?php
class LookupPrivateKeyApplicationDao extends SecurityDao {

	const PRIVATEKEY = 'private_key';
	const APPLICATIONID = 'application_id';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'confone_lookup_application';
	const TABLE = 'privatekey_application';

// ============================================ override functions ==================================================

	public static function getApplicationIdsByPrivateKey($privateKey) {
		$lookup = new LookupPrivateKeyApplicationDao();
		$lookup->setServerAddress(Utility::hashString($privateKey));

		$sql = "SELECT ".LookupPrivateKeyApplicationDao::APPLICATIONID." FROM ".LookupPrivateKeyApplicationDao::TABLE." WHERE "
				.LookupPrivateKeyApplicationDao::PRIVATEKEY."='$privateKey'";

		$connect = DBUtil::getConn($lookup);
		$res = DBUtil::selectData($connect, $sql);

		if ($res) {
			return $res[LookupPrivateKeyApplicationDao::APPLICATIONID];
		} else {
			return 0;
		}
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupPrivateKeyApplicationDao::IDCOLUMN] = 0;
		$this->var[LookupPrivateKeyApplicationDao::PRIVATEKEY] = '';
		$this->var[LookupPrivateKeyApplicationDao::APPLICATIONID] = 0;
	}

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->var[AccountDao::PRIVATEKEY]);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupPrivateKeyApplicationDao::SHARDDOMAIN;
	}

	public function getTableName() {
		return LookupPrivateKeyApplicationDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupPrivateKeyApplicationDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>