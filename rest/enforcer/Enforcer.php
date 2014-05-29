<?php
abstract class Enforcer {

	private $ruleObj = null;
	private $subject = null;
	private $data = null;

	public function Enforcer($rule, $subject, $data=null) {
		$this->ruleObj = $rule;
		$this->subject = $subject;
		$this->data = $data;
	}

	protected function getRuleObj() {
		return $this->ruleObj;
	}

	protected function getSubject() {
		return $this->subject;
	}

	protected function getData() {
		return $this->data;
	}

	public function getErrorMessage() {
		return null;
	}

	abstract public function enforce();
}
?>