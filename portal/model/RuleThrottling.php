<?php
class RuleThrottling extends ModelRule {

	const TYPE = 'RuleThrottling';

	protected function getDaoInstance($id) {
		return new RuleThrottlingDao($id);
	}

	public function getUrl() {
		return '/rule/throttling?id='.$this->getId();
	}

	public function getType() {
		return 'throttling';
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
    public function setDuration($duration) {
    	$this->dao->setDuration($duration);
    }
    public function getDuration() {
        return $this->dao->getDuration();
    }
    public function setAllowance($allowance) {
    	$this->dao->setAllowance($allowance);
    }
    public function getAllowance() {
        return $this->dao->getAllowance();
    }
    public function setWaitTime($waitTime) {
        $this->dao->setWaitTime($waitTime);
    }
    public function getWaitTime() {
        return $this->dao->getWaitTime();
    }
    public function getCreateTime() {
        return $this->dao->getCreateTime();
    }
    public function getModifiedTime() {
        return $this->dao->getModifiedTime();
    }
}
?>