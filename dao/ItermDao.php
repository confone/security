<?php
class ItermDao extends ItermDaoParent {

// ============================================ override functions ==================================================

	public static function getListOfIterms($filter) {
		$relations = ItermRelationDao::getChildrenItemCode($filter);
		$relation = reset($relations);

		$iterm = new ItermDao();
		$iterm->setServerAddress(Utility::hashString($relation->getType()));

		$range = array();
		foreach ($relations as $relation) {
			array_push($range, $relation->getChildId());
		}

		$builder = new QueryBuilder($iterm);
		$rows = $builder->select('*')->in('id', $range)->findList();

		return $ruleType->makeObjectsFromSelectListResult($rows, 'ItermDao');
	}

// ============================================ override functions ==================================================

	protected function beforeInsert() {
		$this->setActive('Y');

		$sequence = Utility::hashString($this->getType());
		$this->setShardId($sequence);
	}

	protected function isShardBaseObject() {
		return false;
	}
}
?>