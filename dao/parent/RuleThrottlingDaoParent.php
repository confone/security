<?php
abstract class RuleThrottlingDaoParent extends SecurityDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['name'] = '';
        $this->var['description'] = '';
        $this->var['duration'] = '';
        $this->var['allowance'] = '';
        $this->var['wait_time'] = '';
        $this->var['create_time'] = '';
        $this->var['modified_time'] = '';

        $this->update['id'] = false;
        $this->update['name'] = false;
        $this->update['description'] = false;
        $this->update['duration'] = false;
        $this->update['allowance'] = false;
        $this->update['wait_time'] = false;
        $this->update['create_time'] = false;
        $this->update['modified_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setName($name) {
        $this->var['name'] = $name;
        $this->update['name'] = true;
    }
    public function getName() {
        return $this->var['name'];
    }

    public function setDescription($description) {
        $this->var['description'] = $description;
        $this->update['description'] = true;
    }
    public function getDescription() {
        return $this->var['description'];
    }

    public function setDuration($duration) {
        $this->var['duration'] = $duration;
        $this->update['duration'] = true;
    }
    public function getDuration() {
        return $this->var['duration'];
    }

    public function setAllowance($allowance) {
        $this->var['allowance'] = $allowance;
        $this->update['allowance'] = true;
    }
    public function getAllowance() {
        return $this->var['allowance'];
    }

    public function setWaitTime($waitTime) {
        $this->var['wait_time'] = $waitTime;
        $this->update['wait_time'] = true;
    }
    public function getWaitTime() {
        return $this->var['wait_time'];
    }

    public function setCreateTime($createTime) {
        $this->var['create_time'] = $createTime;
        $this->update['create_time'] = true;
    }
    public function getCreateTime() {
        return $this->var['create_time'];
    }

    public function setModifiedTime($modifiedTime) {
        $this->var['modified_time'] = $modifiedTime;
        $this->update['modified_time'] = true;
    }
    public function getModifiedTime() {
        return $this->var['modified_time'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'rule_throttling';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'security_rule';
    }
}
?>