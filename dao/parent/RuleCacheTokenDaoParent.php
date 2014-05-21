<?php
abstract class RuleCacheTokenDaoParent extends SecurityDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['rule_id'] = '';
        $this->var['token'] = '';

        $this->update['id'] = false;
        $this->update['rule_id'] = false;
        $this->update['token'] = false;
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

    public function setToken($token) {
        $this->var['token'] = $token;
        $this->update['token'] = true;
    }
    public function getToken() {
        return $this->var['token'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'rule_cache_token';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'security_rule';
    }
}
?>