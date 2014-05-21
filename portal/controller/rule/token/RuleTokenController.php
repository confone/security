<?php
class RuleTokenController extends ViewController {

	protected function control() {
		$appId = param('application_id');

		if (!isset($appId)) {
			$this->redirect('/application/list');
		}

		global $_SSESSION;

		$application = new Application($appId);

		if (!$application->isAvailableToUser($_SSESSION->getUserId())) {
			$this->redirect('/application/list');
		}

		$groupId = param('group_id');

		$id = param('id');

		if (isset($id)) {
			if (!$application->hasRule($id)) {
				$this->redirect('/application/list');
			} else {
				$rule = new RuleToken($id);
			}
		}

		$this->render(array(
			'view' => 'rule/token.php',
			'applicationId' => $appId,
			'groupId' => isset($groupId) ? $groupId : null,
			'rule' => isset($rule) ? $rule : null
		));
	}
}
?>