<?php
abstract class LookupUserApplicationDaoParent extends SecurityDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['user_id'] = '';
        $this->var['app_id'] = '';
        $this->var['access_level'] = '';

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['app_id'] = false;
        $this->update['access_level'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setUserId($userId) {
        $this->var['user_id'] = $userId;
        $this->update['user_id'] = true;
    }
    public function getUserId() {
        return $this->var['user_id'];
    }

    public function setAppId($appId) {
        $this->var['app_id'] = $appId;
        $this->update['app_id'] = true;
    }
    public function getAppId() {
        return $this->var['app_id'];
    }

    public function setAccessLevel($accessLevel) {
        $this->var['access_level'] = $accessLevel;
        $this->update['access_level'] = true;
    }
    public function getAccessLevel() {
        return $this->var['access_level'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'lookup_user_application';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'security_lookup_application';
    }
}
?>