<?php
class RuleToken extends ModelRule {

	const TYPE = 'RuleToken';

	protected function getDaoInstance($id) {
		return new RuleTokenDao($id);
	}

	public function getUrl() {
		return '/rule/token?id='.$this->getId();
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