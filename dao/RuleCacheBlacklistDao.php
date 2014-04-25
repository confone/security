<?php
class RuleCacheBlacklistDao extends RuleCacheBlacklistDaoParent {

// ============================================ override functions ==================================================

	public static function getSubjectsInRule($ruleId) {
		$cache = new RuleCacheBlacklistDao();
		$cache->setServerAddress($ruleId);

		$builder = new QueryBuilder($cache);
		$rows = $builder->select('subject')
						->where('rule_id', $ruleId)
						->findList();
		$rv = array();
		if ($rows) {
			foreach ($rows as $row) {
				array_push($rv, $row['subject']);
			}
		}

		return $rv;
	}

	public static function subjectExistInRule($subject, $ruleId) {
		$cache = new RuleCacheBlacklistDao();
		$cache->setServerAddress($ruleId);

		$builder = new QueryBuilder($cache);
		$res = $builder->select('COUNT(*) as count')
					   ->where('subject', $subject)
					   ->where('rule_id', $ruleId)
					   ->find();

		return ($res['count']==0);
	}

	public static function removeSubjectInRule($subject, $ruleId) {
		if (!self::subjectExistInRule($subject, $ruleId)) {
			return;
		}

		$cache = new RuleCacheBlacklistDao();
		$cache->setServerAddress($ruleId);

		$builder = new QueryBuilder($cache);
		$res = $builder->delete()
					   ->where('subject', $subject)
					   ->where('rule_id', $ruleId)
					   ->query();
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