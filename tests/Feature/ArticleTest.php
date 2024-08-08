<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_article()
    {
        $response = $this->postJson('/api/articles', [
            'author' => 'Dadang Supriatna',
            'title' => 'Buku Dongeng',
            'body' => 'Ini contoh isi buku',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('articles', ['title' => 'Buku Dongeng']);
    }

    public function test_get_articles()
    {
        Article::factory()->create(['title' => 'Buku Dongeng 1']);
        Article::factory()->create(['title' => 'Buku Dongeng 2']);

        $response = $this->getJson('/api/articles');

        $response->assertStatus(200)
            ->assertJsonCount(2);
    }

    public function test_get_article_by_id()
    {
        $article = Article::factory()->create(['title' => 'Buku Dongeng']);

        $response = $this->getJson('/api/articles/' . $article->id);

        $response->assertStatus(200)
            ->assertJson(['title' => 'Buku Dongeng']);
    }
}
