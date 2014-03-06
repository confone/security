<?php
class RuleCacheThrottlingDao extends SecurityDao {

	const RULEID = 'rule_id';
	const SUBJECT = 'subject';
	const TIME = 'time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'security_rule_cache';
	const TABLE = 'throttling';

// ============================================ override functions ==================================================

	public static function countSubject($ruleId, $subject, $start, $end) {
		$cache = new RuleCacheThrottlingDao();
		$cache->setServerAddress($ruleId);

		$sql = "SELECT COUNT(*) as count FROM ".RuleCacheThrottlingDao::TABLE." WHERE "
				.RuleCacheThrottlingDao::SUBJECT."='$subject' AND "
				.RuleCacheThrottlingDao::TIME.">$start AND "
				.RuleCacheThrottlingDao::TIME."<=$end";

		$connect = DBUtil::getConn($cache);
		$res = DBUtil::selectData($connect, $sql);

		return $res['count'];
	}

	public static function removeOldCache($ruleId, $subject, $cutOff) {
		$cache = new RuleCacheThrottlingDao();
		$cache->setServerAddress($ruleId);

		$sql = "DELETE FROM ".RuleCacheThrottlingDao::TABLE." WHERE "
				.RuleCacheThrottlingDao::SUBJECT."='$subject' AND "
				.RuleCacheThrottlingDao::TIME."<=$cutOff";

		$connect = DBUtil::getConn($cache);
		DBUtil::deleteData($connect, $sql);
	}


// ============================================ override functions ==================================================

	protected function init() {
		$this->var[RuleCacheThrottlingDao::IDCOLUMN] = 0;
		$this->var[RuleCacheThrottlingDao::RULEID] = 0;
		$this->var[RuleCacheThrottlingDao::SUBJECT] = '';
		$this->var[RuleCacheThrottlingDao::TIME] = 0;
	}

	protected function beforeInsert() {
		$sequence = $this->var[RuleCacheThrottlingDao::RULEID];
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return RuleCacheThrottlingDao::SHARDDOMAIN;
	}

	public function getTableName() {
		return RuleCacheThrottlingDao::TABLE;
	}

	public function getIdColumnName() {
		return RuleCacheThrottlingDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>