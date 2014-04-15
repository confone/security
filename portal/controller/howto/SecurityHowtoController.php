<?php
class SecurityHowtoController extends ViewController {

	protected function control() {
		$this->render(array(
			'view' => 'howto/index.php'
		));
	}
}
?>