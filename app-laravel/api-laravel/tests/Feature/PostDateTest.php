<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostDateTest extends TestCase
{
    use RefreshDatabase;

    private User $adminUser;
    private Category $category;
    private Tag $tag;

    /** @test */
    public function post_can_save_date_in_y_m_d_format()
    {
        $postData = [
            'title' => 'Test Post with Date',
            'content' => 'Test post content',
            'date' => '2025-01-15',
            'category_id' => $this->category->id,
            'tags' => [$this->tag->id],
            'status' => 1,
            'is_featured' => 0,
            'description' => 'Test description',
        ];

        $response = $this->actingAs($this->adminUser)
            ->withoutMiddleware()
            ->post('/admin/posts', $postData);

        $response->assertRedirect('/admin/posts');

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post with Date',
            'date' => '2025-01-15',
        ]);

        $post = Post::where('title', 'Test Post with Date')->first();
        $this->assertEquals('2025-01-15', $post->date);
    }

    /** @test */
    public function post_can_update_date_in_y_m_d_format()
    {
        $post = Post::factory()->create([
            'title' => 'Original Post',
            'date' => '2024-01-01',
            'category_id' => $this->category->id,
            'user_id' => $this->adminUser->id,
        ]);

        $updateData = [
            'title' => 'Updated Post',
            'content' => 'Updated content',
            'date' => '2025-02-20',
            'category_id' => $this->category->id,
            'tags' => [$this->tag->id],
            'status' => 1,
            'is_featured' => 0,
            'description' => 'Updated description',
        ];

        $response = $this->actingAs($this->adminUser)
            ->withoutMiddleware()
            ->put("/admin/posts/{$post->id}", $updateData);

        $response->assertRedirect('/admin/posts');

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Post',
            'date' => '2025-02-20',
        ]);

        $post->refresh();
        $this->assertEquals('2025-02-20', $post->date);
    }

    /** @test */
    public function post_date_mutator_handles_empty_date()
    {
        $post = new Post();
        $post->date = '';

        $this->assertNull($post->getAttributes()['date']);
    }

    /** @test */
    public function post_date_mutator_handles_null_date()
    {
        $post = new Post();
        $post->date = null;

        $this->assertNull($post->getAttributes()['date']);
    }

    /** @test */
    public function post_date_mutator_converts_valid_date()
    {
        $post = new Post();
        $post->date = '2025-01-15';

        $this->assertEquals('2025-01-15', $post->getAttributes()['date']);
    }

    /** @test */
    public function post_date_accessor_returns_saved_date()
    {
        $post = Post::factory()->create([
            'date' => '2025-01-15',
            'category_id' => $this->category->id,
            'user_id' => $this->adminUser->id,
        ]);

        $this->assertEquals('2025-01-15', $post->date);
    }

    /** @test */
    public function post_date_accessor_returns_null_for_empty_date()
    {
        $post = Post::factory()->create([
            'date' => null,
            'category_id' => $this->category->id,
            'user_id' => $this->adminUser->id,
        ]);

        $this->assertNull($post->date);
    }

    /** @test */
    public function debug_post_creation_with_specific_date()
    {
        $testDate = '2025-07-06';

        $postData = [
            'title' => 'Debug Post Date Test',
            'content' => 'Testing date functionality',
            'date' => $testDate,
            'category_id' => $this->category->id,
            'tags' => [$this->tag->id],
            'status' => 1,
            'is_featured' => 0,
            'description' => 'Debug test',
        ];

        $response = $this->actingAs($this->adminUser)
            ->withoutMiddleware()
            ->post('/admin/posts', $postData);

        $response->assertRedirect('/admin/posts');

        $post = Post::where('title', 'Debug Post Date Test')->first();

        $this->assertNotNull($post, 'Post was not created');
        $this->assertEquals($testDate, $post->date, "Expected date: {$testDate}, got: " . $post->date);

        // Check raw database value
        $rawDate = $post->getAttributes()['date'];
        $this->assertEquals($testDate, $rawDate, "Raw DB date should be: {$testDate}, got: " . $rawDate);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::factory()->create([
            'is_admin' => true,
        ]);

        $this->category = Category::factory()->create();
        $this->tag = Tag::factory()->create();
    }
}
