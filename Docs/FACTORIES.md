# Demo data creation

### before
```
php artisan tinker
```

## Main part


### Factories
```
User::factory()->create();
Post::factory()->create();
Category::factory()->create();
Tag::factory()->create();
```

### Create user
```
\App\Models\User::add(['name' => 'admin', 'email' => 'admin@admin.net', 'is_admin' => 1, 'password' => bcrypt('admin')]);
```

### Fill posts
```
\App\Models\Post::add(['title' => 'My blog post #1', 'content' => 'content of my post #1']);
\App\Models\Post::add(['title' => 'My blog post #2', 'content' => 'content of my post #2']);
```



## Ecommerce part

### Fill some test orders:
```
Order::factory()->count(4)->create();
//or
\Dionisvl\Shop\Models\Order::add(['title' => 'order 1', 'price' => '350']);
```
### Products
```
\Dionisvl\Shop\Models\Product::add(['title' => 'Product #1', 'price' => '300']);
\Dionisvl\Shop\Models\Product::add(['title' => 'Product #2', 'price' => '500']);
```

