<?php
class ApplicationDetailController extends ViewController {

	protected function control() {
		$this->render(array(
			'view' => 'application/detail.php'
		));
	}
}
?>