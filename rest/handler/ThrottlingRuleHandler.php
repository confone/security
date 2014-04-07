<?php
class ThrottlingRuleHandler extends Handler {

	protected function handle($params) {
		$body = Utility::getJsonRequestData();

		$rules = $this->getValidator()->getRules();

		$errors = array();
		foreach ($rules as $rule) {
			if ($rule instanceof RuleThrottlingDao) {
				$enforcher = new ThrottlingRuleEnforcer($rule, $params['subject']);
			}

			if (!$enforcher->enforce()) {
				array_push($errors, $rule->getErrorMessage());
			}
		}

		if (empty($errors)) {
			return array('status'=>'success');
		} else {
			return array('status'=>'error', 'description'=>$errors);
		}
	}
}
?>