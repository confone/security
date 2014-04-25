<?php
class RuleWhitelist extends Model {

	const TYPE = 'RuleWhitelist';

	private $dao = null;

	public function getId() {
		return $this->dao->getId();
	}
	protected function init() {
		$input = $this->getInput();
		if (is_numeric($input)) {
			$this->dao = new RuleWhitelistDao($input);
		} else {
			$this->dao = $this->getInput();
		}
	}
	public function persist() {
		$this->dao->save();
	}

	public function getUrl() {
		return '/rule/whitelist?id='.$this->getId();
	}

    public function getName() {
        return $this->var['name'];
    }
    public function setDescription($description) {
        $this->var['description'] = $description;
        $this->update['description'] = true;
    }
    public function getDescription() {
        return $this->var['description'];
    }
    public function getCreateTime() {
        return $this->var['create_time'];
    }
    public function getModifiedTime() {
        return $this->var['modified_time'];
    }
}
?>