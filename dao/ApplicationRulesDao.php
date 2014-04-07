<?php
class ApplicationRulesDao extends ApplicationRulesDaoParent {

	const RULE_TYPE_THROTTLING = 'THROTTLING';

// =============================================== public function =================================================

	public static function getRulesByApplicationId($applicationId) {
		$rules = new ApplicationRulesDao();
		$rules->setServerAddress($applicationId);

		$builder = new QueryBuilder($rules);
		$rows = $builder->select('*')
						->where('app_id', $applicationId)
						->order('rule_order')
						->findList();

		return $rules->makeObjectsFromSelectListResult($rows, 'ApplicationRulesDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = gmdate('Y-m-d H:i:s');
		$this->setCreateTime($date);
		$this->setModifiedTime($date);

		$sequence = $this->getAppId();
		$this->setShardId($sequence);
	}

	protected function beforeUpdate() {
		$date = gmdate('Y-m-d H:i:s');
		$this->setModifiedTime($date);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>