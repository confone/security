<?php
abstract class ApplicationDaoParent extends SecurityDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['user_id'] = '';
        $this->var['name'] = '';
        $this->var['description'] = '';
        $this->var['public_key'] = '';
        $this->var['private_key'] = '';
        $this->var['create_time'] = '';

        $this->update['id'] = false;
        $this->update['user_id'] = false;
        $this->update['name'] = false;
        $this->update['description'] = false;
        $this->update['public_key'] = false;
        $this->update['private_key'] = false;
        $this->update['create_time'] = false;
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

    public function setPublicKey($publicKey) {
        $this->var['public_key'] = $publicKey;
        $this->update['public_key'] = true;
    }
    public function getPublicKey() {
        return $this->var['public_key'];
    }

    public function setPrivateKey($privateKey) {
        $this->var['private_key'] = $privateKey;
        $this->update['private_key'] = true;
    }
    public function getPrivateKey() {
        return $this->var['private_key'];
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
        return 'application';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'security_application';
    }
}
?>