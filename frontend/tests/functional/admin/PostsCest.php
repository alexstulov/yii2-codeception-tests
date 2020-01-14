<?php namespace frontend\tests\functional\admin;
use common\models\Post;
use frontend\tests\fixtures\PostFixture;
use frontend\tests\FunctionalTester;
use yii\helpers\Url;

class PostsCest
{
    public function _before(FunctionalTester $I)
    {
        $I->haveFixtures([
            'user' => [
                'class' => PostFixture::className(),
                'dataFile' => codecept_data_dir() . 'post.php'
            ]
        ]);
    }

    public function testIndex(FunctionalTester $I)
    {
        $I->amOnPage('/post/index');
        $I->see('Posts', 'h1');
    }

    public function testView(FunctionalTester $I)
    {
        $I->amOnPage(['post/view', 'id' => 1]);
        $I->see('First Post', 'h1');
    }

    public function testCreateInvalid(FunctionalTester $I)
    {
        $I->amOnPage('post/create');
        $I->see('Create', 'h1');

        $I->submitForm('#post-form', [
            'Post[title]' => '',
            'Post[text]' => '',
        ]);

        $I->expectTo('see validation errors');
        $I->see('Title cannot be blank.', '.help-block');
        $I->see('Text cannot be blank.', '.help-block');
    }

    public function testCreateValid(FunctionalTester $I)
    {
        $I->amOnPage('post/create');
        $I->see('Create', 'h1');

        $I->submitForm('#post-form', [
            'Post[title]' => 'Post Create Title',
            'Post[text]' => 'Post Create Text',
            'Post[status]' => 'Active',
        ]);

        $I->expectTo('see view page');
        $I->see('Post Create Title', 'h1');
    }

    public function testDelete(FunctionalTester $I)
    {
        /*
         * DELETE CAN NOT BE TESTED BECAUSE sendAjaxPostRequest ALLOWED ONLY FOR ACCEPTANCE TESTS
         */
//        $I->amOnPage(['post/view', 'id' => 3]);
//        $I->see('Title for deleting', 'h1');
//
//        $I->amGoingTo('delete item');
//        $I->sendAjaxPostRequest(Url::to(['yii2testing/post/delete/3', 'id' => 3]));
//        $I->expectTo('see that post is deleted');
//        $I->dontSeeRecord(Post::className(), [
//            'title' => 'Title for deleting',
//        ]);
    }
}
