<?php
class AppGroupDao extends AppGroupDaoParent {

	const ROOT_GROUP = '_ROOT';

// =============================================== public function =================================================

	public static function getApplicationRootGroup($appId) {
		$appGroup = new AppGroupDao();
		$sequence = $appId;
		$appGroup->setServerAddress($sequence);

		$builder = new QueryBuilder($appGroup);
		$res = $builder->select('*')
					   ->where('app_id', $appId)
					   ->where('group_name', self::ROOT_GROUP)
					   ->find();

		return SecurityDaoBase::makeObjectFromSelectResult($res, 'AppGroupDao');
	}

	public static function getApplicationGroups($appId) {
		$appGroup = new AppGroupDao();
		$sequence = $appId;
		$appGroup->setServerAddress($sequence);

		$builder = new QueryBuilder($appGroup);
		$rows = $builder->select('*')
						->where('app_id', $appId)
						->find();

		return SecurityDaoBase::makeObjectsFromSelectListResult($rows, 'AppGroupDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = gmdate('Y-m-d H:i:s');
		$this->setCreateTime($date);
		$this->setModifiedTime($date);
		$this->setActive('Y');

		$sequence = $this->getAppId();
		$this->setShardId($sequence);
	}

	protected function beforeUpdate() {
		$date = gmdate('Y-m-d H:i:s');
		$this->setModifiedTime($date);

		$sequence = $this->getAppId();
		$this->setServerAddress($sequence);
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>