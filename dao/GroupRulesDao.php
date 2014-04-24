<?php
class GroupRulesDao extends GroupRulesDaoParent {

	const RULE_TYPE_THROTTLING = 'THROTTLING';

// =============================================== public function =================================================

	public static function getRulesByApplicationIdAndGroupId($applicationId, $groupId) {
		$rules = new GroupRulesDao();
		$rules->setServerAddress($applicationId);

		$builder = new QueryBuilder($rules);
		$rows = $builder->select('*')
						->where('app_id', $applicationId)
						->where('group_id', $groupId)
						->order('rule_order')
						->findList();

		return SecurityDaoBase::makeObjectsFromSelectListResult($rows, 'GroupRulesDao');
	}

	public function updateRuleOrder($order) {
		if ($this->getRuleOrder()==$order) { return; }

		$sequence = $this->getAppId();
		$this->setServerAddress($sequence);

		$builder = new QueryBuilder($this);
		$builder->select('*')->where('app_id', $applicationId)->where('group_id', $groupId);
		if ($order > $this->getRuleOrder()) {
			$builder->where('rule_order', $this->getRuleOrder(), '>')->where('rule_order', $order, '<=');
			$isLow = true;
		} else {
			$builder->where('rule_order', $order, '>=')->where('rule_order', $this->getRuleOrder(), '<');
			$isLow = false;
		}
		$rows = $builder->findList();

		$daos = SecurityDaoBase::makeObjectsFromSelectListResult($rows, 'GroupRulesDao');

		foreach ($daos as $dao) {
			$order = $dao->getRuleOrder();
			if ($isLow) {
				$dao->setRuleOrder($order-1);
			} else {
				$dao->setRuleOrder($order+1);
			}
			$dao->save();
		}

		$this->setRuleOrder($order);
		$this->save();
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = gmdate('Y-m-d H:i:s');
		$this->setCreateTime($date);
		$this->setModifiedTime($date);
		$this->setActive('Y');

		$sequence = $this->getAppId();
		$this->setShardId($sequence);

		$builder = new QueryBuilder($this);
		$res = $builder->select('COUNT(*) as count')
					   ->where('app_id', $this->getAppId())
					   ->where('group_id', $this->getGroupId())
					   ->order('rule_order')
					   ->findt();

		$order = $res['count']+1;
		$this->setRuleOrder($order);
	}

	protected function beforeUpdate() {
		$date = gmdate('Y-m-d H:i:s');
		$this->setModifiedTime($date);

		$sequence = $this->getAppId();
		$this->setServerAddress($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>