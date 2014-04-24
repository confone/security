<?php
class GroupDetailController extends ViewController {

	protected function control() {
		$applicationId = param('application_id');

		if (!isset($applicationId)) {
			$this->redirect('/application/list');
		}

		global $_SSESSION;

		$application = new Application($applicationId);

		if (!$application->isAvailableToUser($_SSESSION->getUserId())) {
			$this->redirect('/application/list');
		}

		$groupId = param('id');

		$group = new Group($applicationId, $groupId);

		$this->render( array(
			'title' => 'Application Path Detail | Confone',
			'view' => 'application/group-detail.php',
			'applicationId' => $applicationId,
			'group' => $group
		));
	}
}
?>