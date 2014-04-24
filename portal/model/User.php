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
			$appIds = LookupUserApplicationDao::getApplicationIdsByUserId($this->getId());
			foreach ($appIds as $appId) {
				$application = new ApplicationDao($appId);
				$this->applications[$appId] = new Application($application);
			}
		}

		return $this->applications;
	}
}
?>