<?php

namespace Db;

use PHPUnit\Framework\TestCase;
use src\model\Db;

class DbTest extends TestCase
{
    public function testDbConnectionIsEstablished(): void
    {
        $db = Db::getInstance();
        $this->assertInstanceOf(Db::class, $db::getInstance());
    }

    public function testSingletonInstance(): void
    {
        $db = Db::getInstance();
        $db2 = DB::getInstance();

        $this->assertInstanceOf(Db::class, $db::getInstance());
        $this->assertSame($db, $db2, 'Db::getInstance возвращает один экземпляр');
    }

    public function testQueryReturnsExpectedData(): void
    {
        $sql = 'SELECT * FROM table';
        $expectedData = [['id' => 1, 'name' => 'Test']];

        $pdoStatementMock = $this->createMock(\PDOStatement::class);
        $pdoStatementMock->method('fetchAll')->willReturn($expectedData);

        $pdoMock = $this->createMock(\PDO::class);
        $pdoMock->method('prepare')->willReturn($pdoStatementMock);

        Db::setPDO($pdoMock);

        $db = Db::getInstance();

        $result = $db->query($sql);

        $this->assertEquals($expectedData, $result);
    }

    public function testExecuteReturnsTrueOnSuccess(): void
    {
        $sql = 'UPDATE some_table SET name = ? WHERE id = ?';
        $data = ['New Name', 1];

        $pdoStatementMock = $this->createMock(\PDOStatement::class);
        $pdoStatementMock->method('execute')->willReturn(true);

        $pdoMock = $this->createMock(\PDO::class);
        $pdoMock->method('prepare')->willReturn($pdoStatementMock);

        Db::setPDO($pdoMock);

        $db = Db::getInstance();
        $result = $db->execute($sql, $data);

        $this->assertTrue($result);
    }
}