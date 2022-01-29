<?php

use App\Http\Controllers\Admin\PostsController;
use App\Models\Post;
use Illuminate\Http\Request;

class PostTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * сохранение поста (записи в блоге)
     * тест модели
     * @param $title
     * @param $content
     * @param $date
     * @dataProvider getNewPostsData
     */
    public function test_model_saving_post($title, $content, $date): void
    {
        $fields = [
            'title' => $title,
            'content' => $content,
            'date' => $date,
        ];
        $post = new Post();

        $post::add($fields);

        $this->tester->seeRecord(
            'posts',
            [
                'title' => $title,
                'content' => $content,
            ]
        );
    }

    /**
     * тест контроллера
     * @dataProvider getNewPostsData
     * @param $title
     * @param $content
     * @param $date
     */
    public function test_controller_saving_post($title, $content, $date): void
    {
        $postsController = new PostsController();
        $request = new Request();

        $request->merge([
            'title' => $title,
            'content' => $content,
            'date' => $date,
        ]);

        $postsController->add($request);

        $this->tester->seeRecord(
            'posts',
            [
                'title' => $title,
                'content' => $content,
            ]
        );
    }

    /**
     * @return string[][]
     */
    public function getNewPostsData(): array
    {
        return [
            [
                'title' => 'testPost',
                'content' => 'testContents',
                'date' => '03/04/20',
                'image' => null,
            ],
            [
                'title' => 'testPost2',
                'content' => 'примерный контент 2',
                'date' => '03/04/21',
            ]
        ];
    }
}
