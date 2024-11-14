<?php

interface Expression {
    public function interpret(): int;
}


class Number implements Expression {
    private $value;

    public function __construct(int $value) {
        $this->value = $value;
    }

    public function interpret(): int {
        return $this->value;
    }
}




class Addition implements Expression {
    private $leftExpression;
    private $rightExpression;

    public function __construct(Expression $left, Expression $right) {
        $this->leftExpression = $left;
        $this->rightExpression = $right;
    }

    public function interpret(): int {
        return $this->leftExpression->interpret() + $this->rightExpression->interpret();
    }
}

class Subtraction implements Expression {
    private $leftExpression;
    private $rightExpression;

    public function __construct(Expression $left, Expression $right) {
        $this->leftExpression = $left;
        $this->rightExpression = $right;
    }

    public function interpret(): int {
        return $this->leftExpression->interpret() - $this->rightExpression->interpret();
    }
}

// Create expressions for numbers
$five = new Number(5);
$three = new Number(3);
$two = new Number(2);

// Create addition and subtraction expressions
$addExpr = new Addition($five, $three);       // Represents "5 + 3"
$subtractExpr = new Subtraction($addExpr, $two); // Represents "(5 + 3) - 2"

// Interpret the expression
$result = $subtractExpr->interpret();
echo "Result: $result\n"; // Output: Result: 6
