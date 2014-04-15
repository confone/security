<?php
class SecurityHomeController extends ViewController {

	protected function control() {
		$this->render(array(
			'view' => 'page/home.php'
		));
	}
}
?>