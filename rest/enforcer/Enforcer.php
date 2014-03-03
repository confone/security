<?php
abstract class Enforcer {

	private $ruleObj = null;
	private $subject = null;

	public function Enforcer($rule, $subject) {
		$this->ruleObj = $rule;
		$this->subject = $subject;
	}

	protected function getRuleObj() {
		return $this->ruleObj;
	}

	protected function getSubject() {
		return $this->subject;
	}

	abstract public function enforce();
}
?>