<?php

declare(strict_types=1);

namespace Pozys\QuadraticEquationSolver;

use Pozys\QuadraticEquationSolver\exceptions\ArgumentAIsZeroException;
use Pozys\QuadraticEquationSolver\exceptions\InvalidArgumentTypeException;

final class QuadraticEquationSolver
{
    public static function solve(float $a, float $b, float $c): array
    {
        if (count(array_filter([$a, $b, $c], fn(float $arg) => is_nan($arg) || is_infinite($arg))) > 0) {
            throw new InvalidArgumentTypeException();
        }

        if (abs($a) < PHP_FLOAT_EPSILON) {
            throw new ArgumentAIsZeroException();
        }

        $discriminant = self::calculateDiscriminant($a, $b, $c);

        if ($discriminant < -PHP_FLOAT_EPSILON) {
            return [];
        }

        $roots = self::calculateRoots($a, $b, $discriminant);

        if (abs($discriminant) < PHP_FLOAT_EPSILON) {
            return [$roots[0]];
        }

        return $roots;
    }

    private static function calculateDiscriminant(float $a, float $b, float $c): float
    {
        return $b * $b - 4 * $a * $c;
    }

    private static function calculateRoots(float $a, float $b, float $discriminant): array
    {
        $firstRoot = (-$b + sqrt($discriminant)) / (2 * $a);
        $secondRoot = (-$b - sqrt($discriminant)) / (2 * $a);

        return [$firstRoot, $secondRoot];
    }
}
