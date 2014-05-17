<?php
class SecurityHomeController extends ViewController {

	protected function control() {
		$this->redirect('/application/list');
		$this->render(array(
			'view' => 'page/home.php'
		));
	}
}
?>