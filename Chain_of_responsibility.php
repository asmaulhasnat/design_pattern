<?php

interface SupportHandler {
    public function setNext(SupportHandler $handler): SupportHandler;
    public function handleRequest(string $issue): ?string;
}


abstract class AbstractSupportHandler implements SupportHandler {
    private $nextHandler;

    public function setNext(SupportHandler $handler): SupportHandler {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handleRequest(string $issue): ?string {
        if ($this->nextHandler) {
            return $this->nextHandler->handleRequest($issue);
        }
        return "Issue could not be resolved.";
    }
}



class Level1SupportHandler extends AbstractSupportHandler {
    public function handleRequest(string $issue): ?string {
        if ($issue === "password reset" || $issue === "account setup") {
            return "Level 1 Support: Issue handled at Level 1 - {$issue}\n";
        }
        return parent::handleRequest($issue);
    }
}

class Level2SupportHandler extends AbstractSupportHandler {
    public function handleRequest(string $issue): ?string {
        if ($issue === "software installation" || $issue === "configuration") {
            return "Level 2 Support: Issue handled at Level 2 - {$issue}\n";
        }
        return parent::handleRequest($issue);
    }
}

class Level3SupportHandler extends AbstractSupportHandler {
    public function handleRequest(string $issue): ?string {
        if ($issue === "software bug" || $issue === "system outage") {
            return "Level 3 Support: Issue handled at Level 3 - {$issue}\n";
        }
        return parent::handleRequest($issue);
    }
}




// Set up the chain
$level1 = new Level1SupportHandler();
$level2 = new Level2SupportHandler();
$level3 = new Level3SupportHandler();

$level1->setNext($level2)->setNext($level3);

// Client sends requests
echo $level1->handleRequest("password reset").'<br>';       // Handled by Level 1
echo $level1->handleRequest("software installation").'<br>'; // Handled by Level 2
echo $level1->handleRequest("software bug".'<br>');          // Handled by Level 3
echo $level1->handleRequest("unknown issue").'<br>';         // Not handled, reaches end of chain
