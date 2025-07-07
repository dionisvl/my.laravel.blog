<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PostModelTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function post_can_generate_correct_slug_from_title()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);

        $post = Post::add([
            'title' => 'Laravel Best Practices & Tips',
            'content' => 'Test content about Laravel development',
            'category_id' => $category->id
        ]);

        $this->assertEquals('laravel-best-practices-tips', $post->slug);
    }

    #[Test]
    public function post_can_toggle_status_from_draft_to_public()
    {
        $post = Post::factory()->create(['status' => Post::IS_DRAFT]);

        $this->assertEquals(Post::IS_DRAFT, $post->status);

        $post->toggleStatus(1);
        $this->assertEquals(Post::IS_PUBLIC, $post->status);

        $post->toggleStatus(0);
        $this->assertEquals(Post::IS_DRAFT, $post->status);
    }

    #[Test]
    public function post_can_toggle_featured_status()
    {
        $post = Post::factory()->create(['is_featured' => 0]);

        $this->assertEquals(0, $post->is_featured);

        $post->toggleFeatured(1);
        $this->assertEquals(1, $post->is_featured);

        $post->toggleFeatured(0);
        $this->assertEquals(0, $post->is_featured);
    }

    #[Test]
    public function post_returns_correct_category_title()
    {
        $category = Category::factory()->create(['title' => 'PHP Development']);
        $post = Post::factory()->create(['category_id' => $category->id]);

        $this->assertEquals('PHP Development', $post->getCategoryTitle());
    }

    #[Test]
    public function post_returns_fallback_when_no_category()
    {
        $post = Post::factory()->create(['category_id' => null]);

        $this->assertEquals('No category', $post->getCategoryTitle());
    }

    #[Test]
    public function post_returns_correct_tags_titles()
    {
        $post = Post::factory()->create();
        $tag1 = Tag::factory()->create(['title' => 'Laravel']);
        $tag2 = Tag::factory()->create(['title' => 'PHP']);

        $post->tags()->attach([$tag1->id, $tag2->id]);

        $this->assertEquals('Laravel, PHP', $post->getTagsTitles());
    }

    #[Test]
    public function post_returns_fallback_when_no_tags()
    {
        $post = Post::factory()->create();

        $this->assertEquals('No tags', $post->getTagsTitles());
    }

    #[Test]
    public function post_returns_default_image_when_no_image_uploaded()
    {
        $post = Post::factory()->create(['image' => null]);

        $this->assertEquals('/storage/blog_images/no-image.png', $post->getImage());
    }

    #[Test]
    public function post_returns_uploaded_image_path_when_image_exists()
    {
        $post = Post::factory()->create(['image' => 'test-image.jpg']);

        $this->assertEquals('/storage/uploads/test-image.jpg', $post->getImage());
    }

    #[Test]
    public function post_returns_correct_views_count()
    {
        $post = Post::factory()->create(['views_count' => 0]);
        $this->assertEquals(1, $post->getViewsCount());

        $post = Post::factory()->create(['views_count' => 42]);
        $this->assertEquals(42, $post->getViewsCount());
    }

    #[Test]
    public function post_can_increment_views_count()
    {
        $post = Post::factory()->create(['views_count' => 5]);

        $post->updateViewsCount();

        $this->assertEquals(6, $post->views_count);
    }

    #[Test]
    public function post_returns_stripped_description()
    {
        $post = Post::factory()->create([
            'description' => '<p>This is <strong>HTML</strong> content</p>'
        ]);

        $this->assertEquals('This is HTML content', $post->getDescription());
    }

    #[Test]
    public function post_returns_default_description_when_empty()
    {
        $post = Post::factory()->create(['description' => '']);

        $this->assertEquals(
            'Programming reference for Golang, PHP and JS topics',
            $post->getDescription()
        );
    }

    #[Test]
    public function post_has_category_returns_correct_boolean()
    {
        $category = Category::factory()->create();
        $postWithCategory = Post::factory()->create(['category_id' => $category->id]);
        $postWithoutCategory = Post::factory()->create(['category_id' => null]);

        $this->assertTrue($postWithCategory->hasCategory());
        $this->assertFalse($postWithoutCategory->hasCategory());
    }

    #[Test]
    public function post_can_find_related_posts_by_category()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $post1 = Post::factory()->create(['category_id' => $category1->id]);
        $post2 = Post::factory()->create(['category_id' => $category1->id]);
        $post3 = Post::factory()->create(['category_id' => $category1->id]);

        Post::factory()->create(['category_id' => $category2->id]);

        $relatedPosts = $post1->related();

        $this->assertLessThanOrEqual(5, $relatedPosts->count());
        $this->assertFalse($relatedPosts->contains($post1));
        $this->assertTrue($relatedPosts->contains($post2));
        $this->assertTrue($relatedPosts->contains($post3));
    }
}
