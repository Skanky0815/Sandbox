<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert as PHPUnit;
use Wizmo\Sandbox;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var Sandbox
     */
    private $sandbox;

    /**
     * @var string
     */
    private $result;

    /**
     * @Given /^the Sandbox app$/
     */
    public function theSandboxApp()
    {
        $this->sandbox = new Sandbox();
    }

    /**
     * @Given /^run them$/
     */
    public function runThem()
    {
        $this->result = $this->sandbox->run();
    }

    /**
     * @Then /^it returns "([^"]*)"$/
     */
    public function itReturns($arg1)
    {
        PHPUnit::assertEquals($arg1, $this->result);
    }
}
