<?php
class CreateRuleController extends ViewController {

	protected function control() {
		$applicationId = param('application_id');

		global $_SSESSION;
		$application = new Application($applicationId);

		$redirectUri = '/application/detail?id='.$applicationId;
		if ($application->isAvailableToUser($_SSESSION->getUserId())) {
			$type = param('type');

			$groupId = param('group_id');

			if (!empty($type)) {
				$hasRuleType = false;

				switch ($type) {
					case RuleThrottling::TYPE :
						$hasRuleType = true;
						$input = array();
						$input['name'] = param('name');
						$input['duration'] = param('duration');
						$input['allowance'] = param('allowance');
						$input['wait_time'] = param('wait_time');
						$input['description'] = param('description');
					break;

					case RuleToken::TYPE :
						$hasRuleType = true;
						$input = array();
						$input['name'] = param('name');
						$input['description'] = param('description');
					break;

					case RuleBlacklist::TYPE :
						$hasRuleType = true;
						$input = array();
						$input['name'] = param('name');
						$input['description'] = param('description');
					break;

					case RuleWhitelist::TYPE :
						$hasRuleType = true;
						$input = array();
						$input['name'] = param('name');
						$input['description'] = param('description');
					break;
				}

				if ($hasRuleType) {
					if (!empty($groupId)) {
						$ruleId = $application->addRule($input, $type);
						$group = new Group($applicationId, $groupId);
						$group->addRule($ruleId, $type);
						$redirectUri = '/application/group?application_id='.$applicationId.'&id='.$groupId;
					} else {
						$application->addRule($input, $type, true);
						$redirectUri = '/application/detail?id='.$applicationId;
					}
				}
			}
		}

		$this->redirect($redirectUri);
	}
}
?>