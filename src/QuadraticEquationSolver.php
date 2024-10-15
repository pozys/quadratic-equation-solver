<?php

declare(strict_types=1);

namespace Pozys\QuadraticEquationSolver;

final class QuadraticEquationSolver
{
    public static function solve(float $a, float $b, float $c): array
    {
        $discriminant = self::calculateDiscriminant($a, $b, $c);
        if ($discriminant < 0) {
            return [];
        }

        return self::calculateRoots($a, $b, $discriminant);
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
