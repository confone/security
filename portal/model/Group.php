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
		if ($type==GroupRulesDao::RULE_TYPE_THROTTLING) {
			$ruleDao = new RuleThrottlingDao($ruleId);
		}

		$groupRule = new GroupRulesDao();
		$groupRule->setAppId($this->dao->getAppId());
		$groupRule->setGroupId($this->getId());
		$groupRule->setRuleId($ruleDao->getId());
		$groupRule->save();

		if (!empty($this->rules)) {
			$this->rules[$groupRule->getRuleOrder()] = new RuleThrottling($ruleDao);
		}
	}

	public function getRules() {
		if (empty($this->rules)) {
			$groupRule = GroupRulesDao::getRulesByApplicationIdAndGroupId ( 
									$this->dao->getAppId(), $this->dao->getId() );

			if ($groupRule->getRuleType==GroupRulesDao::RULE_TYPE_THROTTLING) {
				$rule = new RuleThrottling($groupRule->getRuleId());
				$this->rules[$groupRule->getRuleOrder()] = $rule;
			}
		}

		return $this->rules;
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