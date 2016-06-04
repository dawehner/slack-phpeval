<?php

require 'vendor/autoload.php';
use PhpSlackBot\Bot;

// Who Am I Command.
class WhoAmICommand extends \PhpSlackBot\Command\BaseCommand {

    protected function configure() {
        $this->setName('whoami');
    }

    protected function execute($message, $context) {
        $this->send($this->getCurrentChannel(), null, "Hello I'm a bot executing PHP code!");
    }

}

class SimpleEval extends \PhpSlackBot\Command\BaseCommand {

    protected function configure() {
        $this->setName('eval');
    }

    protected function execute($message, $context) {
        $code = substr($message['text'], strlen('eval '));
        $this->send($this->getCurrentChannel(), null, 'Executed code: ' . $code);
        $result = eval($code);
        $this->send($this->getCurrentChannel(), null, print_r($result, TRUE));
    }

}

/**
 * Ideas:
 *   - use psysh as alternative implementation.
 *   - use register_tick_function() to have a timeout.
 */


$bot = new Bot();
$bot->setToken('xoxb-48155999411-IaQZGf5RAgDUs60r63oNgV7H');
$bot->loadCommand(new WhoAmICommand());
$bot->loadCommand(new SimpleEval());
$bot->run();

