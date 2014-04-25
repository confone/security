<?php
class RuleBlacklistDao extends RuleBlacklistDaoParent {

// =============================================== public function =================================================

	public function getErrorMessage() {
		return 'Fail Blacklist Rule - '.$this->getName();
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$date = gmdate('Y-m-d H:i:s');
		$this->setCreateTime($date);
		$this->setModifiedTime($date);
	}

	protected function beforeUpdate() {
		$date = gmdate('Y-m-d H:i:s');
		$this->setModifiedTime($date);
	}

	protected function isShardBaseObject() {
		return true;
	}
}
?>