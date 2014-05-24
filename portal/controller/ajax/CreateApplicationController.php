<?php
class CreateApplicationController extends ViewController {

	protected function control() {
		global $_SSESSION;

		$user = new User($_SSESSION->getUserId());

		$name = param('application_name');
		$description = param('description');
		if (!empty($name)) {
			if ($user->addApplication($name, $description)) {
				$this->redirect('/application/list');
			} else {
				$error = 'System Temporarily NOT available!';
			}
		}

		$this->redirect('/application/list');

//		$this->response(array());
	}
}
?>