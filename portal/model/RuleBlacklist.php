<?php
class RuleBlacklist extends ModelRule {

	const TYPE = 'RuleBlacklist';

	private $subjects = array();

	protected function getDaoInstance($id) {
		return new RuleBlacklistDao($id);
	}

	public function getUrl() {
		return '/rule/blacklist?id='.$this->getId();
	}

	public function addSubject($subject) {
		$cache = new RuleCacheBlacklistDao();
		$cache->setRuleId($this->getId());
		$cache->setSubject($subject);
		$cache->save();

		if (!empty($this->subjects)) {
			array_push($this->subjects, $subject);
		}

		return $cache->getId();
	}

	public function removeSubject($subject) {
		RuleCacheBlacklistDao::removeSubjectInRule($subject, $this->getId());

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
			$this->subjects = RuleCacheBlacklistDao::getSubjectsInRule($this->getId());
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