<?php
abstract class ModelRule extends Model {

	protected $dao = null;

	public function getId() {
		return $this->dao->getId();
	}
	protected function init() {
		$input = $this->getInput();
		if (is_numeric($input)) {
			$this->dao = $this->getDaoInstance($input);
		} else {
			$this->dao = $this->getInput();
		}
	}
	public function persist() {
		$this->dao->save();
	}

	abstract public function getUrl();

	abstract protected function getDaoInstance($id);
}
?>