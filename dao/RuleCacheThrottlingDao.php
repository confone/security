<?php
class RuleCacheThrottlingDao extends RuleCacheThrottlingDaoParent {

// ============================================ override functions ==================================================

	public static function countSubject($ruleId, $subject, $start, $end) {
		$cache = new RuleCacheThrottlingDao();
		$cache->setServerAddress($ruleId);

		$builder = new QueryBuilder($cache);
		$res = $builder->select('COUNT(*) as count')
					   ->where('subject', $subject)
					   ->where('rule_id', $ruleId)
					   ->where('time', $start, '>')
					   ->where('time', $end, '<=')
					   ->find();

		return $res['count'];
	}

	public static function passWaitTime($ruleId, $subject, $now, $waitTime) {
		$cache = new RuleCacheThrottlingDao();
		$cache->setServerAddress($ruleId);

		$builder = new QueryBuilder($cache);
		$res = $builder->select('*')
					   ->where('subject', $subject)
					   ->where('rule_id', $ruleId)
					   ->order('id', true)
					   ->find();

		return ($now-$res['time']) > $waitTime;
	}

	public static function removeOldCache($ruleId, $subject, $cutOff) {
		$cache = new RuleCacheThrottlingDao();
		$cache->setServerAddress($ruleId);

		$builder = new QueryBuilder($cache);
		return $builder->delete()
					   ->where('subject', $subject)
					   ->where('time', $cutOff, '<=')
					   ->query();
	}


// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = $this->getRuleId();
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>