<?php
class RuleThrottlingController extends ViewController {

	protected function control() {
		$this->render(array(
			'view' => 'rule/throttling.php'
		));
	}
}
?>