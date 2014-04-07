<?php
abstract class LookupPrikeyApplicationDaoParent extends SecurityDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['pri_key'] = '';
        $this->var['app_id'] = '';

        $this->update['id'] = false;
        $this->update['pri_key'] = false;
        $this->update['app_id'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setPriKey($priKey) {
        $this->var['pri_key'] = $priKey;
        $this->update['pri_key'] = true;
    }
    public function getPriKey() {
        return $this->var['pri_key'];
    }

    public function setAppId($appId) {
        $this->var['app_id'] = $appId;
        $this->update['app_id'] = true;
    }
    public function getAppId() {
        return $this->var['app_id'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'lookup_prikey_application';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'security_lookup_application';
    }
}
?>