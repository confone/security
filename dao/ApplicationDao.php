<?php
class ApplicationDao extends ApplicationDaoParent {

	const ACCESSLEVEL_NONE = '1000';
	const ACCESSLEVEL_ROOT = '0';
	const ACCESSLEVEL_ADMIN = '1';
	const ACCESSLEVEL_WRITE = '2';
	const ACCESSLEVEL_READ = '3';

// =============================================== public function =================================================

	public static function getApplicationIdByPrivateKey($privateKey) {
		$applicationId = LookupPrikeyApplicationDao::getApplicationIdsByPrivateKey($privateKey);

		if ($applicationId!=0) {
			return $applicationId;
		} else {
			return null;
		}
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$publicKey = 'pub_'.Utility::generateToken('_'.$this->getUserId().'_'.rand(0, 100).'_');
		$privateKey = 'pri_'.Utility::generateToken('_'.$this->getUserId().'_'.rand(0, 100).'_');

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