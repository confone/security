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
		$publicKey = 'pub_'.Utility::generateToken('_'.$this->getOwnerId().'_'.rand(0, 100).'_');
		$privateKey = 'pri_'.Utility::generateToken('_'.$this->getOwnerId().'_'.rand(0, 100).'_');

		$date = gmdate('Y-m-d H:i:s');
		$this->setCreateTime($date);
		$this->setPublicKey($publicKey);
		$this->setPrivateKey($privateKey);

		$lookup = new LookupUserApplicationDao();
		$lookup->setAppId($this->getId());
		$lookup->setUserId($this->getUserId());
		$lookup->save();

		$lookup = new LookupPubkeyApplicationDao();
		$lookup->setAppId($this->getId());
		$lookup->setPubKey($publicKey);
		$lookup->save();

		$lookup = new LookupPrikeyApplicationDao();
		$lookup->setAppId($this->getId());
		$lookup->setPriKey($privateKey);
		$lookup->save();
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>