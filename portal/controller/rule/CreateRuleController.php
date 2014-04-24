<?php
class CreateRuleController extends ViewController {

	protected function control() {
		$this->render(array(
			'view' => 'rule/throttling.php'
		));
	}
}
?>