<?php
class RuleCacheBlacklistDao extends RuleCacheBlacklistDaoParent {

// ============================================ override functions ==================================================

	public static function validateSubjectInRule($subject, $ruleId) {
		$cache = new RuleCacheWhitelistDao();
		$cache->setServerAddress($ruleId);

		$builder = new QueryBuilder($cache);
		$res = $builder->select('COUNT(*) as count')
					   ->where('subject', $subject)
					   ->where('rule_id', $ruleId)
					   ->find();

		return ($res['count']==0);
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