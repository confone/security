<?php
class ThrottlingRuleEnforcer extends Enforcer {

	public function enforce() {
		$rule = $this->getRuleObj();
		$subject = $this->getSubject();

		$end = strtotime('now');
		$duration = $rule->var[RuleThrottlingDao::DURATION];
		$start = $end - $duration;

		global $mongo_database, $mongo_username, $mongo_password;
		$auth = !empty($mongo_username) ? $mongo_username.':'.$mongo_password.'@' : '';

		try {
			$count = RuleCacheThrottlingDao::countSubject ( 
				$rule->var[RuleThrottlingDao::IDCOLUMN], $subject, $start, $end );

			$allowance = $rule->var[RuleThrottlingDao::ALLOWANCE];

			$valid = ($count < $allowance);

			$cache = new RuleCacheThrottlingDao();
			$cache->var[RuleCacheThrottlingDao::RULEID] = $rule->var[RuleThrottlingDao::IDCOLUMN];
			$cache->var[RuleCacheThrottlingDao::SUBJECT] = $subject;
			$cache->var[RuleCacheThrottlingDao::TIME] = $end;
			$cache->save();

			RuleCacheThrottlingDao::removeOldCache ( 
				$rule->var[RuleThrottlingDao::IDCOLUMN], $subject, $start );
		} catch (Exception $e) { $valid = true; }

		return $valid;
	}
}
?>