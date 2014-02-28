<?php
class ApplicationRulesDao extends SecurityDao {

	const APPLICATIONID = 'application_id';
	const RULETYPE = 'rule_type';
	const RULEID = 'rule_id';
	const RULEORDER = 'rule_order';
	const ACTIVE = 'active';
	const CREATETIME = 'create_time';
	const MODIFIEDTIME = 'modified_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'security_application';
	const TABLE = 'rules';


// =============================================== public function =================================================

	public static function getRulesByApplicationId($applicationId) {
		$rules = new ApplicationRulesDao();
		$rules->setServerAddress($applicationId);

		$sql = "SELECT * FROM ".ApplicationRulesDao::TABLE." WHERE "
				.ApplicationRulesDao::APPLICATIONID."=$applicationId ORDER BY "
				.ApplicationRulesDao::RULEORDER;

		$connect = DBUtil::getConn($lookup);
		$rows = DBUtil::selectDataList($connect, $sql);

		return $rules->makeObjectsFromSelectListResult($rows, 'ApplicationRulesDao');
	}


// ============================================ override functions ==================================================

	protected function init() {
		$this->var[ApplicationRulesDao::IDCOLUMN] = 0;
		$this->var[ApplicationRulesDao::APPLICATIONID] = 0;
		$this->var[ApplicationRulesDao::RULETYPE] = 0;
		$this->var[ApplicationRulesDao::RULEID] = 0;
		$this->var[ApplicationRulesDao::RULEORDER] = 0;
		$this->var[ApplicationRulesDao::ACTIVE] = 'N';

		$date = gmdate('Y-m-d H:i:s');
		$this->var[ApplicationRulesDao::CREATETIME] = $date;
		$this->var[ApplicationRulesDao::MODIFIEDTIME] = $date;
	}

	protected function beforeInsert() {
		$sequence = $this->var[ApplicationRulesDao::APPLICATIONID];
		$this->setShardId($sequence);
	}

	protected function beforeUpdate() {
		$date = gmdate('Y-m-d H:i:s');
		$this->var[ApplicationRulesDao::MODIFIEDTIME] = $date;
	}

	public function getShardDomain() {
		return ApplicationRulesDao::SHARDDOMAIN;
	}

	public function getTableName() {
		return ApplicationRulesDao::TABLE;
	}

	public function getIdColumnName() {
		return ApplicationRulesDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>