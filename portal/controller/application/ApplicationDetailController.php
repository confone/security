<?php
class ApplicationDetailController extends ViewController {

	protected function control() {
		$appId = param('id');

		if (!isset($appId)) {
			$this->redirect('/application/list');
		}

		global $_SSESSION;

		$application = new Application($appId);

		if (!$application->isAvailableToUser($_SSESSION->getUserId())) {
			$this->redirect('/application/list');
		}

		$this->render(array(
			'title' => 'Application Information | Confone',
			'view' => 'application/detail.php',
			'application' => $application
		));
	}
}
?>