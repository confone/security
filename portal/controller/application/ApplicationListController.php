<?php
class ApplicationListController extends ViewController {

	protected function control() {
		$this->render(array(
			'view' => 'application/list.php'
		));
	}
}
?>