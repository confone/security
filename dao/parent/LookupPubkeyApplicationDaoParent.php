<?php
abstract class LookupPubkeyApplicationDaoParent extends SecurityDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['pub_key'] = '';
        $this->var['app_id'] = '';

        $this->update['id'] = false;
        $this->update['pub_key'] = false;
        $this->update['app_id'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setPubKey($pubKey) {
        $this->var['pub_key'] = $pubKey;
        $this->update['pub_key'] = true;
    }
    public function getPubKey() {
        return $this->var['pub_key'];
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
        return 'lookup_pubkey_application';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'security_lookup_application';
    }
}
?>