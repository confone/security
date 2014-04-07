<?php
class ApplicationDao extends ApplicationDaoParent {

// =============================================== public function =================================================

	public static function getApplicationByPrivateKey($privateKey) {
		$applicationId = LookupPrikeyApplicationDao::getApplicationIdsByPrivateKey($privateKey);

		if ($applicationId!=0) {
			return new ApplicationDao($applicationId);
		} else {
			return null;
		}
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = gmdate('Y-m-d H:i:s');
		$this->var[ApplicationDao::CREATETIME] = $date;

		$lookup = new LookupUserApplicationDao();
		$lookup->setAppId($this->getId());
		$lookup->setUserId($this->getUserId());
		$lookup->save();

		$lookup = new LookupPubkeyApplicationDao();
		$lookup->setAppId($this->getId());
		$lookup->setPubKey($this->getPublicKey());
		$lookup->save();

		$lookup = new LookupPrikeyApplicationDao();
		$lookup->setAppId($this->getId());
		$lookup->setPriKey($this->getPrivateKey());
		$lookup->save();
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>