<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Pozys\QuadraticEquationSolver\exceptions\ArgumentAIsZeroException;
use Pozys\QuadraticEquationSolver\exceptions\InvalidArgumentTypeException;
use Pozys\QuadraticEquationSolver\QuadraticEquationSolver;

class QuadraticEquationSolverTest extends TestCase
{
    public static function NANProvider(): array
    {
        return [
            [NAN, 1., 0.],
            [1., NAN, 0.],
            [1., 0., NAN],
        ];
    }

    public static function InfProvider(): array
    {
        return [
            [INF, 1., 0.],
            [1., INF, 0.],
            [1., 0., INF],
            [-INF, 1., 0.],
            [1., -INF, 0.],
            [1., 0., -INF],
        ];
    }

    public function testNoRoots(): void
    {
        $a = 1.;
        $b = 0.;
        $c = 1.;

        $this->assertEquals([], QuadraticEquationSolver::solve($a, $b, $c));
    }

    public function testHasTwoRoots(): void
    {
        $a = 1.;
        $b = 0.;
        $c = -1.;

        $roots = QuadraticEquationSolver::solve($a, $b, $c);
        $this->assertCount(2, $roots);

        [$firstRoot, $secondRoot] = $roots;
        $this->assertNotEquals($firstRoot, $secondRoot);
    }

    public function testHasOneRoot(): void
    {
        $a = 1e-10;
        $b = 0;
        $c = 1e-10;

        $roots = QuadraticEquationSolver::solve($a, $b, $c);
        $this->assertCount(1, $roots);
    }

    public function testACanNotBeZero(): void
    {
        $zeroValue = PHP_FLOAT_EPSILON / 10;

        $a = $zeroValue;
        $b = 1.;
        $c = 1.;

        $this->expectException(ArgumentAIsZeroException::class);

        QuadraticEquationSolver::solve($a, $b, $c);
    }

    #[DataProvider('NANProvider')]
    public function testArgumentCanNotBeNAN(float $a, float $b, float $c): void
    {
        $this->expectException(InvalidArgumentTypeException::class);

        QuadraticEquationSolver::solve($a, $b, $c);
    }

    #[DataProvider('InfProvider')]
    public function testArgumentCanNotBeInf(float $a, float $b, float $c): void
    {
        $this->expectException(InvalidArgumentTypeException::class);

        QuadraticEquationSolver::solve($a, $b, $c);
    }
}
