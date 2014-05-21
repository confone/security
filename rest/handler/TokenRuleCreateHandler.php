<?php
class TokenRuleCreateHandler extends Handler {

	protected function handle($params) {
		$body = Utility::getJsonRequestData();

		$rule = $this->getValidator()->getRule();

		$token = 'tok_'.Utility::generateToken('_'.rand(100, 999).'_');

		$cache = new RuleCacheTokenDao();
		$cache->setRuleId($rule->getId());
		$cache->setToken($token);

		$response = array('status'=>'success');
		if ($cache->save()) {
			$response['token'] = $token;
		} else {
			header('HTTP/1.0 500 Internal Server Error');
			$response['status'] = 'error';
		}

		return $response;
	}
}
?>