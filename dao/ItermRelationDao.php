<?php
class ItermRelationDao extends ItermRelationDaoParent {

// ============================================ override functions ==================================================

	public static function getChildrenItemCode($pCode) {
		$relation = new ItermRelationDao();
		$relation->setServerAddress(Utility::hashString($pCode));

		$builder = new QueryBuilder($relation);
		$rows = $builder->select('*')->where('parent_code', $pCode)->findList();

		return $this->makeObjectsFromSelectListResult($rows, 'ItermRelationDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$sequence = Utility::hashString($this->getParentCode());
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>