<?php
class RuleCacheTokenDao extends RuleCacheTokenDaoParent {

// ============================================ override functions ==================================================

	public static function ruleSubjectTokenExist($ruleId, $token) {
		$cache = new RuleCacheTokenDao();
		$cache->setServerAddress($ruleId);

		$builder = new QueryBuilder($cache);
		$res = $builder->select('COUNT(*) as count')
					   ->where('rule_id', $ruleId)
					   ->where('token', $token)
					   ->find();

		return $res['count']>0;
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getRuleId();
		$this->setShardId($sequence);
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