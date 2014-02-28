<?php
class ApplicationDao extends SecurityDao {

	const ACCOUNTID = 'account_id';
	const NAME = 'name';
	const DESCRIPTION = 'description';
	const PUBLICKEY = 'public_key';
	const PRIVATEKEY = 'private_key';
	const CREATETIME = 'create_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'security_application';
	const TABLE = 'application';


// =============================================== public function =================================================



// ============================================ override functions ==================================================

	protected function init() {
		$this->var[ApplicationDao::IDCOLUMN] = 0;
		$this->var[ApplicationDao::ACCOUNTID] = 0;
		$this->var[ApplicationDao::NAME] = '';
		$this->var[ApplicationDao::DESCRIPTION] = '';
		$this->var[ApplicationDao::PUBLICKEY] = '';
		$this->var[ApplicationDao::PRIVATEKEY] = '';

		$date = gmdate('Y-m-d H:i:s');
		$this->var[ApplicationDao::CREATETIME] = $date;
	}

	protected function beforeInsert() {
		$lookup = new LookupImageCodeDao();
		$lookup->var[LookupImageCodeDao::CODE] = $this->var[LookupImageCodeDao::CODE];
		$lookup->var[LookupImageCodeDao::PROJECTPATHID] = $this->var[LookupImageCodeDao::PROJECTPATHID];
		$lookup->var[LookupImageCodeDao::IMAGEID] = $this->var[LookupImageCodeDao::IDCOLUMN];
		$lookup->save();
	}

	public function getShardDomain() {
		return ApplicationDao::SHARDDOMAIN;
	}

	public function getTableName() {
		return ApplicationDao::TABLE;
	}

	public function getIdColumnName() {
		return ApplicationDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>