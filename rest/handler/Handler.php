<?php
abstract class Handler {

    private $validator;
    protected $json;

    public function execute($params) {
        if (isset($this->validator)) {
            $this->json = Utility::getJsonRequestData();

            if (empty($this->json)) {
                $raw = Utility::getRawRequestData();

                if (empty($raw)) { 
                	$this->json = array(); 
                }
                else { 
                	$response = array('status'=>'error','description'=>'invalid_json_format'); 
                }  
            }

            $this->json = empty($_GET) ? $this->json : array_merge($_GET, $this->json);

            $tobeValidated = empty($params) ? $this->json : array_merge($params, $this->json);

            $this->validator->setObjectToBeValidated($tobeValidated);

            if ($this->validator->validate()) {
                $response = $this->handle($params);
            } else {
                $response = $this->onValidationFailed();
            }
        } else {
            $response = $this->handle($params);
        }

        $response = json_encode($response);

        return $response;
    }

    public function setValidator($validator) {
    	$this->validator = $validator;
    }

    protected function getValidator() {
    	return $this->validator;
    }

    abstract protected function handle($params);
}