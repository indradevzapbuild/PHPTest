<?php

namespace PHPTest;

class TestCase {

    protected $name = '';

    public function __construct($name) {
        $this->name = $name;
    }

    public function setUp() {

    }

    public function tearDown() {

    }

    public function run() {
        $this->setUp();
        $this->{$this->name}();
        $this->tearDown();
    }
}