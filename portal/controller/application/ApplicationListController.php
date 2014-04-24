<?php
class ApplicationListController extends ViewController {

	protected function control() {
		global $_SSESSION;

		$user = new User($_SSESSION->getUserId());

		$this->render(array(
			'view' => 'application/list.php',
			'user' => $user
		));
	}
}
?>