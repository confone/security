<?php
class SecurityClientDao extends SecurityDao {

	const APPKEY = 'app_key';
	const NAME = 'name';
	const SCOPE = 'scope';
	const CREATETIME = 'create_time';
	const MODIFIEDTIME = 'modified_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'security_client';
	const TABLE = 'client';


//========================================================================================== public

	/**
	 * Enter description here ...
	 * @param unknown_type $appKey
	 */
	public function getClientByAppKey($appKey) {
		$sql = "SELECT * FROM ".SecurityClientDao::TABLE." WHERE ".SecurityClientDao::APPKEY."='$appKey'";

		$connect = DBUtil::getConn($this);
		$res = DBUtil::selectData($connect, $sql);

		return $this->makeObjectFromSelectResult($res, 'SecurityClientDao');
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[SecurityClientDao::IDCOLUMN] = 0;
		$this->var[SecurityClientDao::APPKEY] = '';
		$this->var[SecurityClientDao::NAME] = '';
		$this->var[SecurityClientDao::SCOPE] = 'account+business+comment+image';

		$datetime = date('Y-m-d H:i:s');
		$this->var[SecurityClientDao::CREATETIME] = $datetime;
		$this->var[SecurityClientDao::MODIFIEDTIME] = $datetime;
	}

	protected function actionBeforeUpdate() {
		$this->var[SecurityClientDao::MODIFIEDTIME] = date('Y-m-d H:i:s');
	}

	protected function getTableName() {
		return SecurityClientDao::TABLE;
	}

	protected function getIdColumnName() {
		return SecurityClientDao::IDCOLUMN;
	}

	public function getShardDomain() {
		return SecurityClientDao::SHARDDOMAIN;
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>