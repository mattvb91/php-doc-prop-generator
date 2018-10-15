<?php

namespace mattvb91\docPropGenerator\tests;

use mattvb91\DocPropGenerator\Generator;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    /** @var Generator */
    protected $_generator;

    protected function setUp()
    {
        parent::setUp();

        $pdo = $this->getMockBuilder(\PDO::class)
            ->disableOriginalConstructor()
            ->getMock();

        $statement = $this->getMockBuilder(\PDOStatement::class)
            ->disableOriginalConstructor()
            ->getMock();

        $statement->expects(self::once())
            ->method('fetchAll')
            ->willReturn(['user', 'book']);

        $userStatement = $this->getMockBuilder(\PDOStatement::class)
            ->disableOriginalConstructor()
            ->getMock();

        $pdo->method('prepare')->willReturnOnConsecutiveCalls(
            $statement,
            $userStatement
        );

        $this->_generator = $this->getMockBuilder(Generator::class)
            ->setMethods(['getPdo'])
            ->getMock();

        $this->_generator->expects(self::exactly(2))
            ->method('getPdo')
            ->willReturn($pdo);

    }

    /**
     * @covers \mattvb91\DocPropGenerator\Generator::generate
     */
    public function testGenerate()
    {
        $this->_generator->generate();
    }
}
