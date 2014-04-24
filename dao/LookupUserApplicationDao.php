<?php
class LookupUserApplicationDao extends LookupUserApplicationDaoParent {

// ============================================ override functions ==================================================

	public static function getApplicationIdsByUserId($userId) {
		$lookup = new LookupUserApplicationDao();
		$lookup->setServerAddress($userId);

		$builder = new QueryBuilder($lookup);
		$rows = $builder->select('app_id')->where('user_id', $userId)->findList();

		$ids = array();
		foreach ($rows as $row) {
			array_push($ids, $row['app_id']);
		}

		return $ids;
	}

	public static function getUserAccessLevelOnProject($appId, $userId) {
		$lookup = new LookupUserApplicationDao();
		$lookup->setServerAddress($userId);

		$builder = new QueryBuilder($lookup);
		$res = $builder->select('access_level')
					   ->where('user_id', $userId)
					   ->where('app_id', $appId)
					   ->find();

		if ($res) {
			return $res['access_level'];
		} else {
			return ApplicationDao::ACCESSLEVEL_NONE;
		}
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getUserId();
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>