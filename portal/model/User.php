<?php
class User extends Model {

	private $applications = array();

	public function getId() {
		return $this->getInput();
	}

	protected function init() {}
    public function persist() {}

	public function addApplication($name, $description='') {
		$rv = false;

		$application = new ApplicationDao();
		$application->setName($name);
		$application->setUserId($this->getId());
		$application->setDescription($description);
		$rv = $application->save();

		$appGroup = new AppGroupDao();
		$appGroup->setAppId($application->getId());
		$appGroup->setGroupName(AppGroupDao::ROOT_GROUP);
		$appGroup->save();

		if (empty($this->applications)) {
			$this->applications[$application->getId()] = new Application($application);
		}

		return $rv;
	}

	public function getApplications() {
		if (empty($this->applications)) {
			$lookups = LookupUserApplicationDao::getApplicationIdsByUserId($this->getId());
			foreach ($lookups as $lookup) {
				$application = new ApplicationDao($lookup->getAppId());
				$this->applications[$lookup->getAppId()] = new Application($application);
			}
		}

		return $this->applications;
	}
}
?>