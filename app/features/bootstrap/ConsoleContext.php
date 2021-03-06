<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;

/**
 * Class ConsoleContext
 */
class ConsoleContext implements Context
{
    /**
     * @var string
     */
    protected $output;

    /**
     * @Given I have a console at :directory
     * @param string $directory
     * @throws \Exception
     */
    public function iHaveACconsoleAt($directory)
    {
        if (!is_dir($directory)) {
            throw new Exception('Directory does not exist.');
        }

        chdir($directory);
    }

    /**
     * @When I run the command :command
     * @param string $command
     * @throws \Exception
     */
    public function iRunTheCommand($command)
    {
        exec($command, $output, $status);

        if (0 !== $status) {
            throw new Exception('Command did not execute successfully.');
        }

        $this->output = $output;
    }

    /**
     * @Then I should get the following output:
     * @param \Behat\Gherkin\Node\PyStringNode $string
     * @throws \Exception
     */
    public function iShouldGetTheFollowingOutput(PyStringNode $string)
    {
        if (implode("\n", $this->output) !== (string) $string) {
            throw new Exception('Command output does not match expected output.');
        }
    }
}
