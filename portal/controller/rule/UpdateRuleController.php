<?php
class UpdateRuleController extends ViewController {

	protected function control() {
		$applicationId = param('application_id');
		$id = param('rule_id');

		$redirectUri = '/application/detail?id='.$applicationId;

		global $_SSESSION;
		$application = new Application($applicationId);

		if ($application->hasRule($id) && 
			$application->isAvailableToUser($_SSESSION->getUserId())) {
			$type = param('type');

			if (!empty($type)) {
				switch ($type) {
					case RuleThrottling::TYPE :
						$rule = new RuleThrottling($id);

						$duration = param('duration');
						$allowance = param('allowance');
						$waitTime = param('wait_time');
						$description = param('description');

						$rule->setAllowance($allowance);
						$rule->setDescription($description);
						$rule->setDuration($duration);
						$rule->setWaitTime($waitTime);
					break;

					case RuleBlacklist::TYPE :
						$rule = new RuleBlacklist($id);

						$description = param('description');
						$rule->setDescription($description);
					break;

					case RuleWhitelist::TYPE :
						$rule = new RuleWhitelist($id);

						$description = param('description');
						$rule->setDescription($description);
					break;
				}

				if (isset($rule)) { 
					$rule->persist();
					$redirectUri = $rule->getUrl().'&application_id='.$applicationId;
				}
			}
		}

		$this->redirect($redirectUri);
	}
}
?>