<?php

require_once "Zend/Test/PHPUnit/ControllerTestCase.php";

class ControllerTestCase
	extends Zend_Test_PHPUnit_ControllerTestCase
{
	protected $_application;

    protected function setUp()
    {
        $this->bootstrap = array($this, 'appBootstrap');
        parent::setUp();
    }

	public function tearDown()
	{
		$this->resetRequest();
		$this->resetResponse();
		parent::tearDown();
	}

    public function appBootstrap()
    {
        $this->_application = new Zend_Application(APPLICATION_ENV,
              APPLICATION_PATH . '/configs/application.ini'
        );
        $this->_application->bootstrap();

        /**
         * Fix for ZF-8193
         * http://framework.zend.com/issues/browse/ZF-8193
         * Zend_Controller_Action->getInvokeArg('bootstrap') doesn't work
         * under the unit testing environment.
         */
        $front = Zend_Controller_Front::getInstance();
        if($front->getParam('bootstrap') === null) {
            $front->setParam('bootstrap', $this->_application->getBootstrap());
        }
    }

	public function setAuth()
	{
		$user = new Application_Model_User();
		$user->setId(10);
		$user->setFirstName('Test');
		$user->setLastName('Tester');

		Zend_Auth::getInstance()->getStorage()->write($user);

	}


}