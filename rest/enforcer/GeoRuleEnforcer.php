<?php
class GeoRuleEnforcer extends Enforcer {

	private $errMsg = null;

	public function enforce() {
		$input = $this->getSubject();

		$validator = new GeoRuleEnforcerValidator();
		$validator->setObjectToBeValidated($input);
		if (!$validator->validate()) {
    		$this->errMsg = $validator->getMessage();
    		return false;
		}

		$subject = $input['subject'];

		$rule = $this->getRuleObj();

		$cache = RuleCacheGeoDao::initWithRuleIdAndSubject($rule->getId(), $subject);

		if (isset($cache)) {
			// get actual distance
	
			$lat1 = $input['lat'];
			$lng1 = $input['lng'];
	
			$lat2 = $cache->getLat();
			$lng2 = $cache->getLng();

			if ($lat1==$lat2 && $lng1==$lng2) {
				$now = gmdate('Y-m-d H:i:s');
				$cache->setCreateTime($now);
				$cache->save();
				return true;
			}
	
			$actual = Utility::distance($lat1, $lng1, $lat2, $lng2);
	
			if ($rule->getUnit()=='0') {
				$actual = $actual * 1.609344;
			}
	
			// get allowed distance
	
			$speed = $rule->getSpeed();
	
			$now = gmdate('Y-m-d H:i:s');
			$then = $cache->getCreateTime();
	
			$nowTime  = strtotime($now);
			$thenTime = strtotime($then);
	
			$seconds = $nowTime - $thenTime;
	
			$allowed = ($speed*$seconds)/3600;
Logger::info($actual.":".$allowed);
			if ($actual<=$allowed) {
				$cache->setLat($lat1);
				$cache->setLng($lng1);
				$cache->setCreateTime($now);
				$cache->save();
				return true;
			}
		} else {
			$cache = new RuleCacheGeoDao();
			$cache->setLat($input['lat']);
			$cache->setLng($input['lng']);
			$cache->setRuleId($rule->getId());
			$cache->setSubject($subject);
			$cache->save();

			return true;
		}

		return false;
	}

	public function getErrorMessage() {
		return $this->errMsg;
	}
}
?>