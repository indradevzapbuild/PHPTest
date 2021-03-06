<?php

namespace PHPTest;

class TestClassTest extends TestClass {

    protected $mock = null;
    protected $result = null;

    public function setUp() {
        $this->result = new TestResult;
        $this->mock = new Mocks\WasRunTest;
    }

    public function testCount() {
        $this->assert(4 == count($this->mock));
    }

    public function testAddPlugin() {
        $this->mock->addPlugin(new \PHPTest\Plugins\Assert($this->mock));
    }

    public function testRunPlugin() {
        $this->mock->addPlugin(new \PHPTest\Plugins\Assert($this->mock));
        $this->mock->assertEquals(true, true);
    }

    public function testRunBadPlugin() {
        $this->mock->addPlugin(new \PHPTest\Plugins\Assert($this->mock));
        try {
            $this->mock->badMethodCall();
            throw new \LogicException('Method was not called');
        } catch (\BadMethodCallException $e) {}
    }

    public function testRunAllTests() {
        $this->mock->run($this->result);
        $this->assert(4 == $this->result->getRunCount());
    }

    public function testDataProvider() {
        $mock = new Mocks\DataProviderTest;
        $mock->run($this->result);
        $this->assertEquals(2, $this->result->getRunCount());
    }

}
