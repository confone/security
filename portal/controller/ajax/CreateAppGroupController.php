<?php
class CreateAppGroupController extends ViewController {

	protected function control() {
		$applicationId = param('application_id');

		global $_SSESSION;
		$application = new Application($applicationId);

		if ($application->isAvailableToUser($_SSESSION->getUserId())) {
			$name = param('group_name');

			$application->addGroup($name);
		}

		$this->redirect('/application/detail?id='.$applicationId);

//		$this->response(array());
	}
}
?>