<?php
class Group extends Model {

	private $dao = null;

	private $rules = array();

	public function getId() {
		return $this->dao->getId();
	}
	protected function init() {
		$input = $this->getInput();
		if (is_array($input)) {
			$this->dao = AppGroupDao::getAppGroupByAppIdAndGroupId($input[0], $input[1]);
		} else {
			$this->dao = $this->getInput();
		}
	}
	public function persist() {
		$this->dao->save();
	}

	public function addRule($ruleId, $type) {
		$groupRule = new GroupRulesDao();

		switch ($type) {
			case RuleThrottling::TYPE :
				$ruleDao = new RuleThrottlingDao($ruleId);
				$groupRule->setRuleType(GroupRulesDao::RULE_TYPE_THROTTLING);
			break;

			case RuleGeo::TYPE :
				$ruleDao = new RuleGeoDao($ruleId);
				$groupRule->setRuleType(GroupRulesDao::RULE_TYPE_GEO);
			break;

			case RuleToken::TYPE :
				$ruleDao = new RuleTokenDao($ruleId);
				$groupRule->setRuleType(GroupRulesDao::RULE_TYPE_TOKEN);
			break;

			case RuleBlacklist::TYPE :
				$ruleDao = new RuleBlacklistDao($ruleId);
				$groupRule->setRuleType(GroupRulesDao::RULE_TYPE_BLACKLIST);
			break;

			case RuleWhitelist::TYPE :
				$ruleDao = new RuleWhitelistDao($ruleId);
				$groupRule->setRuleType(GroupRulesDao::RULE_TYPE_WHITELIST);
			break;
		}

		$groupRule->setAppId($this->dao->getAppId());
		$groupRule->setGroupId($this->getId());
		$groupRule->setRuleId($ruleDao->getId());
		$groupRule->setRuleName($ruleDao->getName());
		$groupRule->save();

		if (!empty($this->rules)) {
			$this->rules[$groupRule->getRuleOrder()] = new RuleThrottling($ruleDao);
		}
	}

	public function getRules() {
		if (empty($this->rules)) {
			$groupRules = GroupRulesDao::getRulesByApplicationIdAndGroupId ( 
									$this->dao->getAppId(), $this->dao->getId() );

			foreach ($groupRules as $groupRule) {
				switch ($groupRule->getRuleType()) {
					case GroupRulesDao::RULE_TYPE_THROTTLING :
						$rule = new RuleThrottling($groupRule->getRuleId());
					break;

					case GroupRulesDao::RULE_TYPE_GEO :
						$rule = new RuleGeo($groupRule->getRuleId());
					break;

					case GroupRulesDao::RULE_TYPE_TOKEN :
						$rule = new RuleToken($groupRule->getRuleId());
					break;

					case GroupRulesDao::RULE_TYPE_BLACKLIST :
						$rule = new RuleBlacklist($groupRule->getRuleId());
					break;

					case GroupRulesDao::RULE_TYPE_WHITELIST :
						$rule = new RuleWhitelist($groupRule->getRuleId());
					break;
				}

				$this->rules[$groupRule->getRuleOrder()] = $rule;
			}
		}

		return $this->rules;
	}

	public function countGroupRules() {
		return GroupRulesDao::countGroupRules($this->dao->getAppId(), $this->dao->getId());
	}

    public function getAppId() {
        return $this->dao->getAppId();
    }
    public function setGroupName($groupName) {
        $this->dao->setGroupName($groupName);
    }
    public function getGroupName() {
        return $this->dao->getGroupName();
    }
    public function isActive() {
        return ($this->dao->getActive()=='Y');
    }
    public function getCreateTime() {
        return $this->dao->getCreateTime();
    }
    public function getModifiedTime() {
        return $this->dao->getModifiedTime();
    }
}