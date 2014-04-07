<?php
class LookupPrikeyApplicationDao extends LookupPrikeyApplicationDaoParent {

// ============================================ override functions ==================================================

	public static function getApplicationIdsByPrivateKey($privateKey) {
		$lookup = new LookupPrikeyApplicationDao();
		$lookup->setServerAddress(Utility::hashString($privateKey));

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('app_id')->where('pri_key', $privateKey)->find();

		if ($res) {
			return $res['app_id'];
		} else {
			return 0;
		}
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->getPriKey());
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>