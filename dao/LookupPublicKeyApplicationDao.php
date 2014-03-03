<?php
class LookupPublicKeyApplicationDao extends SecurityDao {

	const PUBLICKEY = 'public_key';
	const APPLICATIONID = 'application_id';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'confone_lookup_application';
	const TABLE = 'publickey_application';

// ============================================ override functions ==================================================

	public static function getApplicationIdsByPublicKey($publicKey) {
		$lookup = new LookupPublicKeyApplicationDao();
		$lookup->setServerAddress(Utility::hashString($publicKey));

		$sql = "SELECT ".LookupPublicKeyApplicationDao::APPLICATIONID." FROM ".LookupPublicKeyApplicationDao::TABLE." WHERE "
				.LookupPublicKeyApplicationDao::PUBLICKEY."='$publicKey'";

		$connect = DBUtil::getConn($lookup);
		$res = DBUtil::selectDataList($connect, $sql);

		if ($res) {
			return $res[LookupPublicKeyApplicationDao::APPLICATIONID];
		} else {
			return 0;
		}
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[LookupPublicKeyApplicationDao::IDCOLUMN] = 0;
		$this->var[LookupPublicKeyApplicationDao::PUBLICKEY] = '';
		$this->var[LookupPublicKeyApplicationDao::APPLICATIONID] = 0;
	}

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->var[AccountDao::PUBLICKEY]);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return LookupPublicKeyApplicationDao::SHARDDOMAIN;
	}

	public function getTableName() {
		return LookupPublicKeyApplicationDao::TABLE;
	}

	public function getIdColumnName() {
		return LookupPublicKeyApplicationDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>