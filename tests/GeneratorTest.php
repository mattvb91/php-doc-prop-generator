<?php

namespace mattvb91\docPropGenerator\tests;

use mattvb91\DocPropGenerator\Generator;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    public function testGenerate()
    {
        $generator = new Generator();
        $generator->generate();
    }
}
