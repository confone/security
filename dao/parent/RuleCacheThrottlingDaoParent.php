<?php
abstract class RuleCacheThrottlingDaoParent extends SecurityDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['rule_id'] = '';
        $this->var['subject'] = '';
        $this->var['time'] = '';

        $this->update['id'] = false;
        $this->update['rule_id'] = false;
        $this->update['subject'] = false;
        $this->update['time'] = false;
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

    public function setTime($time) {
        $this->var['time'] = $time;
        $this->update['time'] = true;
    }
    public function getTime() {
        return $this->var['time'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'rule_cache_throttling';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'security_rule';
    }
}
?>