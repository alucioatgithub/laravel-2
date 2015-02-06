<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    protected $_faker;

    public function __construct()
    {
        $this->_faker = Faker\Factory::create();

        parent::__construct();
    }

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

}
