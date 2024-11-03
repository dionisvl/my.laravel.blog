<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Dionisvl\FrontParts\Models\FrontPart;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        view()->composer('pages._sidebar', static function ($view) {
            //$view->with('popularPosts', Post::getPopularPosts());
            $view->with('featuredPosts', Post::where('is_featured', 1)->take(3)->get());
            $view->with('recentPosts', Post::orderBy('date', 'desc')->take(4)->get());
            $view->with('categories', Category::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->get());
        });

        view()->composer('layout', static function ($view) {
            $view->with('jsParts', FrontPart::where('type', 'JS')->where('category_name', env('APP_URL'))->pluck('detail_text')->toArray());
            $view->with('cssParts', FrontPart::where('type', 'CSS')->where('category_name', env('APP_URL'))->pluck('detail_text')->toArray());
        });

        view()->composer('admin._sidebar', static function ($view) {
            $view->with([
                'newCommentsCount' => Comment::where('status', 0)->count(),
            ]);
        });

        if (env('FORCE_HTTPS', false) || app()->environment('remote')) {
            URL::forceScheme('https');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {

    }
}
