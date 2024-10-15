<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Pozys\QuadraticEquationSolver\exceptions\ArgumentAIsZeroException;
use Pozys\QuadraticEquationSolver\QuadraticEquationSolver;

class QuadraticEquationSolverTest extends TestCase
{
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
        $a = 1.;
        $b = 2.;
        $c = 1.;

        $roots = QuadraticEquationSolver::solve($a, $b, $c);
        $this->assertCount(2, $roots);

        [$firstRoot, $secondRoot] = $roots;
        $this->assertEquals($firstRoot, $secondRoot);
    }

    public function testACanNotBeZero(): void
    {
        $a = ;
        $b = 1.;
        $c = 1.;

        $this->expectException(ArgumentAIsZeroException::class);

        QuadraticEquationSolver::solve($a, $b, $c);
    }
}
