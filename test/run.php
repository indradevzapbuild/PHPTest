<?php

namespace PHPTest;

//Register both autoloaders
require_once '../src/PHPTest/bootstrap.php';
require_once 'bootstrap.php';

$suite = new \PHPTest\TestSuite;
$suite->add(new \PHPTest\TestCaseTest());
$suite->add(new \PHPTest\TestResultTest());
$suite->add(new \PHPTest\TestSuiteTest());
$suite->add(new \PHPTest\Report\CLITest());

$result = new \PHPTest\TestResult;
$renderer = new \PHPTest\Report\CLI;
$result->attachObserver(function($name, $arg1 = null) use ($result, $renderer, $suite) {
    static $n = 0;
    static $m = 0;
    $out = $renderer->update($result, $name, $arg1);
    if ($out) {
        echo $out;
        $n++;
        if ($n > 5) {
            $m += $n;
            $n = 0;
            echo " ($m/".count($suite).") \n";
        }
    }
});
$suite->run($result);


echo "\n\n" . $renderer->render($result);