<?php

namespace News;

use PHPUnit\Framework\TestCase;
use src\Model\Db;
use src\model\News\Article;

class ArticleTest extends TestCase
{
    public function testFindByIdReturnsModelOnSuccess(): void
    {
        $expectedId = 1;
        $expectedData = [new Article()];
        $expectedData[0]->id = $expectedId;

        $pdoStatementMock = $this->createMock(\PDOStatement::class);
        $pdoStatementMock->method('fetchAll')->willReturn($expectedData);

        $pdoMock = $this->createMock(\PDO::class);
        $pdoMock->method('prepare')->willReturn($pdoStatementMock);

        Db::setPDO($pdoMock);

        $result = Article::findById($expectedId);

        $this->assertInstanceOf(Article::class, $result);
        $this->assertEquals($expectedId, $result->id);
    }

    public function testFindByIdReturnsFalseOnFailure(): void
    {
        $pdoStatementMock = $this->createMock(\PDOStatement::class);
        $pdoStatementMock->method('fetchAll')->willReturn([]);

        $pdoMock = $this->createMock(\PDO::class);
        $pdoMock->method('prepare')->willReturn($pdoStatementMock);

        Db::setPDO($pdoMock);

        $result = Article::findById(67575);

        $this->assertFalse($result);
    }

    public function testFindAllReturnsArrayOnSuccess(): void
    {
        $expectedData = [new Article()];

        $pdoStatementMock = $this->createMock(\PDOStatement::class);
        $pdoStatementMock->method('fetchAll')->willReturn($expectedData);

        $pdoMock = $this->createMock(\PDO::class);
        $pdoMock->method('prepare')->willReturn($pdoStatementMock);

        Db::setPDO($pdoMock);

        $result = Article::findAll();

        $this->assertIsArray($result);

        foreach ($result as $item) {
            $this->assertInstanceOf(Article::class, $item);
        }
    }

    public function testInsertFunctionModel(): void
    {
        $expectedId = '1';
        $expectedTitle = 'TestTitle';
        $expectedContent = 'TestContent';
        $expectedAuthorId = 1;

        $article = new Article();
        $article->id = $expectedId;
        $article->title = $expectedTitle;
        $article->content = $expectedContent;
        $article->author_id = $expectedAuthorId;

        $pdoStatementMock = $this->createMock(\PDOStatement::class);
        $pdoStatementMock->method('execute')->willReturn(true);

        $pdoMock = $this->createMock(\PDO::class);
        $pdoMock->method('prepare')->willReturn($pdoStatementMock);
        $pdoMock->method('lastInsertId')->willReturn($expectedId);

        Db::setPDO($pdoMock);

        $article->insert();

        $this->assertEquals($expectedId, $article->id);
        $this->assertEquals($expectedTitle, $article->title);
        $this->assertEquals($expectedContent, $article->content);
        $this->assertEquals($expectedAuthorId, $article->author_id);
    }

    public function testDeleteFunctionModel(): void
    {
        $expectedId = 1;

        $article = new Article();
        $article->id = $expectedId;

        $pdoStatementMock = $this->createMock(\PDOStatement::class);
        $pdoStatementMock->expects($this->once())
            ->method('execute')
            ->with([':id' => $expectedId])
            ->willReturn(true);

        $pdoMock = $this->createMock(\PDO::class);
        $pdoMock->method('prepare')->willReturn($pdoStatementMock);

        Db::setPDO($pdoMock);

        $success = $article->delete();

        $this->assertTrue($success);
    }

    public function testUpdateFunctionModel(): void
    {
        $expectedId = '1';
        $expectedTitle = 'TestTitle';
        $expectedContent = 'TestContent';
        $expectedAuthorId = 1;

        $article = new Article();
        $article->id = $expectedId;
        $article->title = $expectedTitle;
        $article->content = $expectedContent;
        $article->author_id = $expectedAuthorId;

        $pdoStatementMock = $this->createMock(\PDOStatement::class);
        $pdoStatementMock->expects($this->once())
            ->method('execute')
            ->with($this->anything())
            ->willReturn(true);

        $pdoMock = $this->createMock(\PDO::class);
        $pdoMock->method('prepare')->willReturn($pdoStatementMock);

        Db::setPDO($pdoMock);

        $success = $article->update();

        $this->assertTrue($success);
    }
}