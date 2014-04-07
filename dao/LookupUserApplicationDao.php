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