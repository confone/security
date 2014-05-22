<?php
class RuleWhitelist extends ModelRule {

	const TYPE = 'RuleWhitelist';

	protected function getDaoInstance($id) {
		return new RuleWhitelistDao($id);
	}

	public function getUrl() {
		return '/rule/whitelist?id='.$this->getId();
	}

	public function getType() {
		return 'whitelist';
	}

	public function addSubject($subject) {
		$cache = new RuleCacheWhitelistDao();
		$cache->setRuleId($this->getId());
		$cache->setSubject($subject);
		$cache->save();

		if (!empty($this->subjects)) {
			array_push($this->subjects, $subject);
		}

		return $cache->getId();
	}

	public function removeSubject($subject) {
		RuleCacheWhitelistDao::removeSubjectInRule($subject, $this->getId());

		if (!empty($this->subjects)) {
			foreach ($this->subjects as $key=>$val) {
				if ($val==$subject) {
					unset($this->subjects[$key]);
				}
			}
		}
	}

	public function getSubjects() {
		if (empty($this->subjects)) {
			$this->subjects = RuleCacheWhitelistDao::getSubjectsInRule($this->getId());
		}

		return $this->subjects;
	}

    public function getName() {
        return $this->dao->getName();
    }
    public function setDescription($description) {
        $this->dao->setDescription($description);
    }
    public function getDescription() {
        return $this->dao->getDescription();
    }
    public function getCreateTime() {
        return $this->dao->getCreateTime();
    }
    public function getModifiedTime() {
        return $this->dao->getModifiedTime();
    }
}
?>