<?php namespace Post;


use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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

    // tests
    public function testSavingPost()
    {
/*
        $fields = [
            'title' => 'testPost',
            'content' => 'testContents',
        ];
        $post = new Post();

        $post->fill($fields);
        $post->slug = Str::slug($fields['title']);
        $post->user_id = 1;
        $post->save();


        $this->tester->seeInDatabase('posts', ['title' => 'testPost', 'content' => 'testContents']);
*/
    }
}
