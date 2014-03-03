<?php
class ThrottlingRuleEnforcer extends Enforcer {

	public function enforce() {
		$rule = $this->getRuleObj();
		$subject = $this->getSubject();

		$end = strtotime('now');
		$interval = $rule->var[RuleThrottlingDao::INTERVAL];
		$start = $end - $interval;

		global $mongo_database, $mongo_username, $mongo_password;
		$auth = !empty($mongo_username) ? $mongo_username.':'.$mongo_password : '';

		try {
			$connection = new MongoClient('mongodb://'.$auth.'@'.$mongo_database);
			$collection = $connection->throttling->requests;

			$query = array (
				'time' => array( '$gt'=>$start, '$lt'=>$end )
			);
			$count = $collection->count($query);

			$allowance = $rule->var[RuleThrottlingDao::ALLOWANCE];

			$valid = ($count <= $allowance);

			$document = array('subject'=>$subject, 'time'=>$end);
			$collection->insert($document);
			$collection->remove(array('time'=>array('$lt'=>$start)));

			$connection->close();
		} catch (Exception $e) { $valid = true; }

		return $valid;
	}
}
?>