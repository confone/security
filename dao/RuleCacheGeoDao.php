<?php
class RuleCacheGeoDao extends RuleCacheGeoDaoParent {

// ============================================ override functions ==================================================

	public static function initWithRuleIdAndSubject($ruleId, $subject) {
		$cache = new RuleCacheGeoDao();
		$cache->setServerAddress($ruleId);

		$builder = new QueryBuilder($cache);
		$res = $builder->select('*')
					   ->where('subject', $subject)
					   ->where('rule_id', $ruleId)
					   ->find();

		return self::makeObjectFromSelectResult($res, 'RuleCacheGeoDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = gmdate('Y-m-d H:i:s');
		$sequence = $this->getRuleId();
		$this->setShardId($sequence);
		$this->setCreateTime($date);
	}

	protected function beforeUpdate() {
		$sequence = $this->getRuleId();
		$this->setServerAddress($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>