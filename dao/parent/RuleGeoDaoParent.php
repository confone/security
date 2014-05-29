<?php
abstract class RuleGeoDaoParent extends SecurityDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['name'] = '';
        $this->var['speed'] = '';
        $this->var['unit'] = '';
        $this->var['description'] = '';
        $this->var['create_time'] = '';
        $this->var['modified_time'] = '';

        $this->update['id'] = false;
        $this->update['name'] = false;
        $this->update['speed'] = false;
        $this->update['unit'] = false;
        $this->update['description'] = false;
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

    public function setSpeed($speed) {
        $this->var['speed'] = $speed;
        $this->update['speed'] = true;
    }
    public function getSpeed() {
        return $this->var['speed'];
    }

    public function setUnit($unit) {
        $this->var['unit'] = $unit;
        $this->update['unit'] = true;
    }
    public function getUnit() {
        return $this->var['unit'];
    }

    public function setDescription($description) {
        $this->var['description'] = $description;
        $this->update['description'] = true;
    }
    public function getDescription() {
        return $this->var['description'];
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
        return 'rule_geo';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'security_rule';
    }
}
?>