<?php
namespace frontend\tests\unit\models;

use Codeception\Test\Unit;
use common\models\Post;
use frontend\tests\fixtures\PostFixture;

class PostTest extends Unit
{
    /*
     * @var \UnitTester
     */
    protected $tester;

    public function _before()
    {
        $this->tester->haveFixtures([
            'post' => [
                'class' => PostFixture::className(),
                'dataFile' => codecept_data_dir() . 'post.php'
            ]
        ]);
    }

    public function testValidateEmpty()
    {
        $model = new Post();

        expect('model should not validate', $model->validate())->false();
        expect('title has error', $model->errors)->hasKey('title');
        expect('text has error', $model->errors)->hasKey('text');
    }

    public function testValidateCorrect()
    {
        $model = new Post([
            'title' => 'Other Post',
            'text' => 'Other Post Text',
        ]);

        expect('model should validate', $model->validate())->true();
    }

    public function testSave()
    {
        $model = new Post([
            'title' => 'Test Post',
            'text' => 'Test Post Text',
        ]);

        expect('model should save', $model->save())->true();

        expect('title is correct', $model->title)->equals('Test Post');
        expect('title is correct', $model->text)->equals('Test Post Text');
        expect('status is draft', $model->status)->equals(Post::STATUS_DRAFT);
        expect('created_at is generated', $model->created_at)->notEmpty();
        expect('updated_at is generated', $model->updated_at)->notEmpty();
    }

    public function testPublish()
    {
        $model = new Post(['status' => Post::STATUS_DRAFT]);

        expect('post is drafted', $model->status)->equals(Post::STATUS_DRAFT);
        $model->publish();
        expect('post is published', $model->status)->equals(Post::STATUS_ACTIVE);
    }

    public function testAlreadyPublished()
    {
        $model = new Post(['status' => Post::STATUS_ACTIVE]);

        $this->expectException('\DomainException');
        $model->publish();
    }

    public function testDraft()
    {
        $model = new Post(['status' => Post::STATUS_ACTIVE]);

        expect('post is published', $model->status)->equals(Post::STATUS_ACTIVE);
        $model->draft();
        expect('post is drafted', $model->status)->equals(Post::STATUS_DRAFT);
    }

    public function testAlreadyDrafted()
    {
        $model = new Post(['status' => Post::STATUS_DRAFT]);

        $this->expectException('\DomainException');
        $model->draft();
    }

    // INTEGRATION TESTS LOOKS LIKE SAVING AND ACCESSING THE DB AND OTHER MODELS
    public function testFindPostById()
    {
        $model = Post::findOne(1);
        expect('post title is', $model->title)->equals('First Post');
    }
}