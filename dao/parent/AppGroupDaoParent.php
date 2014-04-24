<?php
abstract class AppGroupDaoParent extends SecurityDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['app_id'] = '';
        $this->var['group_name'] = '';
        $this->var['active'] = '';
        $this->var['create_time'] = '';
        $this->var['modified_time'] = '';

        $this->update['id'] = false;
        $this->update['app_id'] = false;
        $this->update['group_name'] = false;
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

    public function setGroupName($groupName) {
        $this->var['group_name'] = $groupName;
        $this->update['group_name'] = true;
    }
    public function getGroupName() {
        return $this->var['group_name'];
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
        return 'app_group';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'security_application';
    }
}
?>