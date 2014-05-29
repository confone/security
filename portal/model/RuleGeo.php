<?php
class RuleGeo extends ModelRule {

	const TYPE = 'RuleGeo';

	protected function getDaoInstance($id) {
		return new RuleGeoDao($id);
	}

	public function getUrl() {
		return '/rule/geodetic?id='.$this->getId();
	}

	public function getType() {
		return 'geodetic';
	}

    public function getName() {
        return $this->dao->getName();
    }
    public function setSpeed($speed) {
    	$this->dao->setSpeed($speed);
    }
    public function getSpeed() {
    	return $this->dao->getSpeed();
    }
    public function setUnit($unit) {
    	$this->dao->setUnit($unit);
    }
    public function getUnit() {
    	return $this->dao->getUnit();
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