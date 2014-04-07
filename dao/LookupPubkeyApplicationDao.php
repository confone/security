<?php
class LookupPubkeyApplicationDao extends LookupPubkeyApplicationDaoParent {

// ============================================ override functions ==================================================

	public static function getApplicationIdsByPublicKey($publicKey) {
		$lookup = new LookupPubkeyApplicationDao();
		$lookup->setServerAddress(Utility::hashString($publicKey));

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('app_id')->where('pub_key', $privateKey)->find();

		if ($res) {
			return $res['app_id'];
		} else {
			return 0;
		}
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->getPubKey());
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>