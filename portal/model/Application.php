<?php
class Application extends Model {

	private $dao = null;

	private $rootGroup = null;

	private $groups = array();

	public function getId() {
		return $this->dao->getId();
	}
	protected function init() {
		$input = $this->getInput();
		if (is_numeric($input)) {
			$this->dao = new ApplicationDao($input);
		} else {
			$this->dao = $this->getInput();
		}
	}
	public function persist() {
		$this->dao->save();
	}

	public function addRule($input, $type, $isRootGroup=false) {
		switch ($type) {
			case RuleThrottling::TYPE :
				$ruleDao = new RuleThrottlingDao();
				$ruleDao->setName($input['name']);
				$ruleDao->setDuration($input['duration']);
				$ruleDao->setAllowance($input['allowance']);
				$ruleDao->setWaitTime($input['wait_time']);
				$ruleDao->setDescription($input['description']);
				$ruleDao->save();
			break;

			case RuleGeo::TYPE :
				$ruleDao = new RuleGeoDao();
				$ruleDao->setName($input['name']);
				$ruleDao->setSpeed($input['speed']);
				$ruleDao->setUnit($input['unit']);
				$ruleDao->setDescription($input['description']);
				$ruleDao->save();
			break;

			case RuleToken::TYPE :
				$ruleDao = new RuleTokenDao();
				$ruleDao->setName($input['name']);
				$ruleDao->setDescription($input['description']);
				$ruleDao->save();
			break;

			case RuleBlacklist::TYPE :
				$ruleDao = new RuleBlacklistDao();
				$ruleDao->setName($input['name']);
				$ruleDao->setDescription($input['description']);
				$ruleDao->save();
			break;

			case RuleWhitelist::TYPE :
				$ruleDao = new RuleWhitelistDao();
				$ruleDao->setName($input['name']);
				$ruleDao->setDescription($input['description']);
				$ruleDao->save();
			break;
		}

		if ($isRootGroup) {
			$this->getRootGroup()->addRule($ruleDao->getId(), $type);
		}

		return $ruleDao->getId();
	}

    public function getRootGroup() {
    	if (!isset($this->rootGroup)) {
    		$groupDao = AppGroupDao::getApplicationRootGroup($this->getId());
    		$this->rootGroup = new Group($groupDao);
    	}

    	return $this->rootGroup;
    }

    public function addGroup($name) {
    	if (empty($name)) { return -1; }

    	$appGroupDao = new AppGroupDao();
    	$appGroupDao->setAppId($this->getId());
    	$appGroupDao->setGroupName($name);
    	$appGroupDao->save();

    	if (!empty($this->groups)) {
    		array_push($this->groups, new Group($appGroupDao));
    	}

    	return $appGroupDao->getId();
    }

    public function getGroupCount() {
    	return AppGroupDao::countApplicationGroups($this->getId());
    }

    public function getGroups() {
    	if (empty($this->groups)) {
    		$appGroups = AppGroupDao::getApplicationGroups($this->getId());
    		foreach ($appGroups as $appGroup) {
    			if ($appGroup->getGroupName()!=AppGroupDao::ROOT_GROUP) {
    				array_push($this->groups, new Group($appGroup));
    			}
    		}
    	}

    	return $this->groups;
    }

    public function hasRule($ruleId) {
    	return GroupRulesDao::isRuleInApplication($ruleId, $this->getId());
    }

    public function getRuleCount() {
    	return GroupRulesDao::countApplicationRules($this->getId());
    }

    public function isAvailableToUser($userId) {
    	$access = LookupUserApplicationDao::getUserAccessLevelOnProject($this->getId(), $userId);
    	return $access != ApplicationDao::ACCESSLEVEL_NONE;
    }

    public function getUserId() {
        return $this->dao->getUserId();
    }
    public function getName() {
        return $this->dao->getName();
    }
    public function getDescription() {
        return $this->dao->getDescription();
    }
    public function getPublicKey() {
        return $this->dao->getPublicKey();
    }
    public function getPrivateKey() {
        return $this->dao->getPrivateKey();
    }
    public function getCreateTime() {
        return $this->dao->getCreateTime();
    }
}
?>