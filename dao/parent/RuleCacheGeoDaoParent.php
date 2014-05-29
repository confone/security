<?php
abstract class RuleCacheGeoDaoParent extends SecurityDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['rule_id'] = '';
        $this->var['subject'] = '';
        $this->var['lat'] = '';
        $this->var['lng'] = '';
        $this->var['create_time'] = '';

        $this->update['id'] = false;
        $this->update['rule_id'] = false;
        $this->update['subject'] = false;
        $this->update['lat'] = false;
        $this->update['lng'] = false;
        $this->update['create_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setRuleId($ruleId) {
        $this->var['rule_id'] = $ruleId;
        $this->update['rule_id'] = true;
    }
    public function getRuleId() {
        return $this->var['rule_id'];
    }

    public function setSubject($subject) {
        $this->var['subject'] = $subject;
        $this->update['subject'] = true;
    }
    public function getSubject() {
        return $this->var['subject'];
    }

    public function setLat($lat) {
        $this->var['lat'] = $lat;
        $this->update['lat'] = true;
    }
    public function getLat() {
        return $this->var['lat'];
    }

    public function setLng($lng) {
        $this->var['lng'] = $lng;
        $this->update['lng'] = true;
    }
    public function getLng() {
        return $this->var['lng'];
    }

    public function setCreateTime($createTime) {
        $this->var['create_time'] = $createTime;
        $this->update['create_time'] = true;
    }
    public function getCreateTime() {
        return $this->var['create_time'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'rule_cache_geo';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'security_rule';
    }
}
?>