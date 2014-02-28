<?php
class ItermRuleTypeDao extends SecurityDao {

	const TYPE = 'type';
	const LANGUAGE = 'language';
	const DESCRIPTION = 'description';
	const GROUP = 'group';
	const ACTIVE = 'active';

	const IDCOLUMN = 'id';
	const SHARDDOMAIN = 'security_iterm';
	const TABLE = 'rule_type';

// ============================================ override functions ==================================================

	public static function getAllRuleTypes() {
		$ruleType = new ItermRuleTypeDao();
		$ruleType->setServerAddress(Utility::hashString('RuleType'));

		$sql = "SELECT * FROM ".ItermRuleTypeDao::TABLE;

		$connect = DBUtil::getConn($ruleType);
		$rows = DBUtil::selectDataList($connect, $sql);

		return $ruleType->makeObjectsFromSelectListResult($rows, 'ItermRuleTypeDao');
	}

// ============================================ override functions ==================================================

	protected function init() {
		$this->var[ItermRuleTypeDao::IDCOLUMN] = 0;
		$this->var[ItermRuleTypeDao::TYPE] = 0;
		$this->var[ItermRuleTypeDao::LANGUAGE] = '';
		$this->var[ItermRuleTypeDao::DESCRIPTION] = '';
		$this->var[ItermRuleTypeDao::GROUP] = 'RuleType';
		$this->var[ItermRuleTypeDao::ACTIVE] = 'N';
	}

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->var[ItermRuleTypeDao::GROUP]);
		$this->setShardId($sequence);
	}

	public function getShardDomain() {
		return ItermRuleTypeDao::SHARDDOMAIN;
	}

	public function getTableName() {
		return ItermRuleTypeDao::TABLE;
	}

	public function getIdColumnName() {
		return ItermRuleTypeDao::IDCOLUMN;
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>