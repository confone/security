<?php
class RuleWhitelistAddController extends ViewController {

	protected function control() {
		$applicationId = param('application_id');
		$ruleId = param('rule_id');
		$subject = param('subject');

		global $_SSESSION;
		$application = new Application($applicationId);

		$redirectUri = '/application/detail?id='.$applicationId;
		if ($application->isAvailableToUser($_SSESSION->getUserId())) {
			$cache = new RuleCacheWhitelistDao();
			$cache->setRuleId($ruleId);
			$cache->setSubject($subject);
			$cache->save();
			$redirectUri = '/rule/whitelist?id='.$ruleId.'&application_id='.$applicationId;
		}

		$this->redirect($redirectUri);
	}
}
?>