<?php
class RuleThrottlingDao extends SecurityDao {

	const NAME = 'name';
	const DESCRIPTION = 'description';
	const INTERVAL = 'interval';
	const ALLOWANCE = 'allowance';
	const CREATETIME = 'create_time';
	const MODIFIEDTIME = 'modified_time';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'security_rule';
	const TABLE = 'throttling';


// =============================================== public function =================================================

	public function getErrorMessage() {
		return 'Fail Throttling Rule - '.$this->var[RuleThrottlingDao::NAME];
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[RuleThrottlingDao::IDCOLUMN] = 0;
		$this->var[RuleThrottlingDao::NAME] = '';
		$this->var[RuleThrottlingDao::DESCRIPTION] = '';
		$this->var[RuleThrottlingDao::INTERVAL] = 0;
		$this->var[RuleThrottlingDao::ALLOWANCE] = 0;

		$date = gmdate('Y-m-d H:i:s');
		$this->var[RuleThrottlingDao::CREATETIME] = $date;
		$this->var[RuleThrottlingDao::MODIFIEDTIME] = $date;
	}

	protected function beforeUpdate() {
		$date = gmdate('Y-m-d H:i:s');
		$this->var[RuleThrottlingDao::MODIFIEDTIME] = $date;
	}

	public function getShardDomain() {
		return RuleThrottlingDao::SHARDDOMAIN;
	}

	public function getTableName() {
		return RuleThrottlingDao::TABLE;
	}

	public function getIdColumnName() {
		return RuleThrottlingDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>