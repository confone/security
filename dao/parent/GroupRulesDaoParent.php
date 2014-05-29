<?php
abstract class GroupRulesDaoParent extends SecurityDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['app_id'] = '';
        $this->var['group_id'] = '';
        $this->var['rule_type'] = '';
        $this->var['rule_id'] = '';
        $this->var['rule_name'] = '';
        $this->var['rule_order'] = '';
        $this->var['active'] = '';
        $this->var['create_time'] = '';
        $this->var['modified_time'] = '';

        $this->update['id'] = false;
        $this->update['app_id'] = false;
        $this->update['group_id'] = false;
        $this->update['rule_type'] = false;
        $this->update['rule_id'] = false;
        $this->update['rule_name'] = false;
        $this->update['rule_order'] = false;
        $this->update['active'] = false;
        $this->update['create_time'] = false;
        $this->update['modified_time'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setAppId($appId) {
        $this->var['app_id'] = $appId;
        $this->update['app_id'] = true;
    }
    public function getAppId() {
        return $this->var['app_id'];
    }

    public function setGroupId($groupId) {
        $this->var['group_id'] = $groupId;
        $this->update['group_id'] = true;
    }
    public function getGroupId() {
        return $this->var['group_id'];
    }

    public function setRuleType($ruleType) {
        $this->var['rule_type'] = $ruleType;
        $this->update['rule_type'] = true;
    }
    public function getRuleType() {
        return $this->var['rule_type'];
    }

    public function setRuleId($ruleId) {
        $this->var['rule_id'] = $ruleId;
        $this->update['rule_id'] = true;
    }
    public function getRuleId() {
        return $this->var['rule_id'];
    }

    public function setRuleName($ruleName) {
        $this->var['rule_name'] = $ruleName;
        $this->update['rule_name'] = true;
    }
    public function getRuleName() {
        return $this->var['rule_name'];
    }

    public function setRuleOrder($ruleOrder) {
        $this->var['rule_order'] = $ruleOrder;
        $this->update['rule_order'] = true;
    }
    public function getRuleOrder() {
        return $this->var['rule_order'];
    }

    public function setActive($active) {
        $this->var['active'] = $active;
        $this->update['active'] = true;
    }
    public function getActive() {
        return $this->var['active'];
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
        return 'group_rules';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'security_application';
    }
}
?>