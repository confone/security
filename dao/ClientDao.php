<?php
class ClientDao extends ClientDaoParent {
	
// ============================================ override functions ==================================================

	/**
	 * Enter description here ...
	 * @param unknown_type $appKey
	 */
	public function getClientByAppKey($appKey) {
		$builder = new QueryBuilder($this);
		$res = $builder->select('*')->where('app_key', $appKey)->find();

		return $this->makeObjectFromSelectResult($res, 'SecurityClientDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$datetime = gmdate('Y-m-d H:i:s');
		$this->setCreateTime($datetime);
		$this->setModifiedTime($datetime);
	}

	protected function beforeUpdate() {
		$datetime = gmdate('Y-m-d H:i:s');
		$this->setModifiedTime($datetime);
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>