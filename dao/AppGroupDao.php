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
						->findList();

		return SecurityDaoBase::makeObjectsFromSelectListResult($rows, 'AppGroupDao');
	}

	public static function getAppGroupByAppIdAndGroupId($appId, $groupId) {
		$appGroup = new AppGroupDao();
		$sequence = $appId;
		$appGroup->setServerAddress($sequence);

		$builder = new QueryBuilder($appGroup);
		$res = $builder->select('*')
					   ->where('app_id', $appId)
					   ->where('id', $groupId)
					   ->find();

		return SecurityDaoBase::makeObjectFromSelectResult($res, 'AppGroupDao');
	}

	public static function getGroupIdByAppIdAndGroupName($appId, $groupName) {
		$appGroup = new AppGroupDao();
		$sequence = $appId;
		$appGroup->setServerAddress($sequence);

		$builder = new QueryBuilder($appGroup);
		$res = $builder->select('id')
					   ->where('app_id', $appId)
					   ->where('group_name', $groupName)
					   ->find();
		if ($res) {
			return $res['id'];
		} else {
			return -1;
		}
	}

	public static function countApplicationGroups($appId) {
		$appGroup = new AppGroupDao();
		$sequence = $appId;
		$appGroup->setServerAddress($sequence);

		$builder = new QueryBuilder($appGroup);
		$res = $builder->select('COUNT(*) as count')
					   ->where('app_id', $appId)
					   ->find();

		return $res['count']-1;
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