<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminPostsTest extends TestCase
{
    use RefreshDatabase;

    private User $adminUser;
    private Category $category;
    private Tag $tag;

    #[Test]
    public function admin_can_create_post()
    {
        $postData = [
            'title' => 'Test Post Title',
            'content' => 'Test post content',
            'date' => '2024-01-01',
            'category_id' => $this->category->id,
            'tags' => [$this->tag->id],
            'status' => 1,
            'is_featured' => 1,
            'description' => 'Test description',
        ];

        $response = $this->actingAs($this->adminUser)
            ->withoutMiddleware()
            ->post('/admin/posts', $postData);


        $response->assertRedirect('/admin/posts');

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post Title',
            'content' => 'Test post content',
            'category_id' => $this->category->id,
            'status' => 1,
            'is_featured' => 1,
        ]);

        $post = Post::where('title', 'Test Post Title')->first();
        $this->assertTrue($post->tags->contains($this->tag));
    }

    #[Test]
    public function admin_can_create_post_with_image()
    {
        $image = UploadedFile::fake()->image('test.jpg');

        $postData = [
            'title' => 'Test Post with Image',
            'content' => 'Test post content with image',
            'date' => '2024-01-01',
            'category_id' => $this->category->id,
            'tags' => [$this->tag->id],
            'status' => 1,
            'is_featured' => 0,
            'image' => $image,
        ];

        $response = $this->actingAs($this->adminUser)
            ->withoutMiddleware()
            ->post('/admin/posts', $postData);

        $response->assertRedirect('/admin/posts');

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post with Image',
            'content' => 'Test post content with image',
        ]);

        $post = Post::where('title', 'Test Post with Image')->first();
        $this->assertNotNull($post->image);
    }

    #[Test]
    public function guest_cannot_create_post()
    {
        $postData = [
            'title' => 'Test Post Title',
            'content' => 'Test post content',
            'date' => '2024-01-01',
            'category_id' => $this->category->id,
        ];

        $response = $this->withoutMiddleware(VerifyCsrfToken::class)
            ->post('/admin/posts', $postData);

        $response->assertStatus(404); // Route не найден без middleware
    }

    #[Test]
    public function non_admin_cannot_create_post()
    {
        $user = User::factory()->create(['is_admin' => false]);

        $postData = [
            'title' => 'Test Post Title',
            'content' => 'Test post content',
            'date' => '2024-01-01',
            'category_id' => $this->category->id,
        ];

        $response = $this->actingAs($user)
            ->withoutMiddleware(VerifyCsrfToken::class)
            ->post('/admin/posts', $postData);

        $response->assertStatus(404); // Route не найден без admin middleware
    }

    #[Test]
    public function create_post_validates_required_fields()
    {
        $response = $this->actingAs($this->adminUser)
            ->withoutMiddleware()
            ->post('/admin/posts', []);

        $response->assertSessionHasErrors(['title', 'content', 'date']);
    }

    #[Test]
    public function create_post_validates_image_type()
    {
        $file = UploadedFile::fake()->create('document.pdf', 1000);

        $postData = [
            'title' => 'Test Post Title',
            'content' => 'Test post content',
            'date' => '2024-01-01',
            'category_id' => $this->category->id,
            'image' => $file,
        ];

        $response = $this->actingAs($this->adminUser)
            ->withoutMiddleware()
            ->post('/admin/posts', $postData);

        $response->assertSessionHasErrors(['image']);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::factory()->create([
            'is_admin' => true,
        ]);

        $this->category = Category::factory()->create();
        $this->tag = Tag::factory()->create();

        Storage::fake('public');
    }
}
