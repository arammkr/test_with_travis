<?php
namespace Tests\Http\Controllers\Api;

use ApiTester;
use Tests\TestData\AuthorTestData;

class ArticleControllerTest extends ApiTester
{
    /**  @test */
    public function if_fetches_articles()
    {
        $this->getJson('/api/v1/articles');

        $this->assertResponseOk();
    }

    /** @test */
    public function it_fetches_a_single_article()
    {
        $this->getJson('/api/v1/articles/1');

        $this->assertApiStatusOk();
    }

    /**  @test */
    public function it_test_response_if_article_not_found()
    {
        $this->getJson('/api/v1/articles/15615156');

        $this->assertApiStatusNotFound();
    }

    /**  @test */
    public function it_create_new_article()
    {
        $this->login();
        $this->getJson(
            '/api/v1/articles',
            'POST',
            [
                'title' => 'New test article 1',
                'body' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                'author_id' => AuthorTestData::getRandomAuthor()->id,
                '_token' => $this->token(),
            ]
        );
        $this->assertApiStatusOk();
    }

    /** @test */
    public function it_test_create_new_test_require_login()
    {
        $this->getJson('/api/v1/articles', 'POST', [
            'title' => 'New test article 1',
            'body' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'author_id' => AuthorTestData::getRandomAuthor()->id,
            '_token' => $this->token(),
        ]);
        $this->assertApiStatusNotAuth();
    }

    /** @test */
    public function it_create_and_delete_article()
    {
        $this->login();
        $newArticleResult = $this->getJson('/api/v1/articles', 'POST', [
            'title' => 'New test article 1',
            'body' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            'author_id' => AuthorTestData::getRandomAuthor()->id,
            '_token' => $this->token(),
        ]);
        $this->assertApiStatusOk();

        $article = $newArticleResult['data']['article'];

        $this->getJson('/api/v1/articles/' . $article['id'], 'DELETE', [
            '_token' => $this->token(),
        ]);
        $this->assertApiStatusOk();
    }
}
