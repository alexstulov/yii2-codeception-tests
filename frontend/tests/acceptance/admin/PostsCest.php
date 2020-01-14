<?php
namespace frontend\tests\acceptance\admin;

use frontend\tests\AcceptanceTester;
use frontend\tests\fixtures\PostFixture;
use yii\helpers\Url;

class PostsCest
{
    function _before(AcceptanceTester $I)
    {
        $I->haveFixtures([
            'post' => [
                'class' => PostFixture::className(),
                'dataFile' => codecept_data_dir() . 'post.php'
            ]
        ]);
    }

    public function testIndex(AcceptanceTester $I)
    {
        $I->wantTo('ensure that post index page works');
        $I->amOnPage(Url::to(['/post/index']));
        $I->see('Post', 'h1');
    }

    public function testView(AcceptanceTester $I)
    {
        $I->wantTo('ensure that post view page works');
        $I->amOnPage(Url::to(['/post/view', 'id' => 1]));
        $I->see('First Post', 'h1');
    }

    public function testCreate(AcceptanceTester $I)
    {
        $I->wantTo('ensure that post create page works');
        $I->amOnPage(Url::to(['/post/create']));
        $I->see('Create', 'h1');

        $I->fillField('#post-title', 'Post Create Title');
        $I->fillField('#post-text', 'Post Create Text');
        $I->selectOption('#post-status', 'Active');

        $I->click('button[type=submit]');
        $I->wait(3);

        $I->expectTo('see view page');
        $I->see('Post Create Title', 'h1');
    }

    public function testDelete(AcceptanceTester $I)
    {
        $I->amOnPage(Url::to(['/post/view', 'id' => 3]));
        $I->see('Title For Deleting', 'h1');

        $I->click('Delete');
        $I->acceptPopup();
        $I->wait(3);

        $I->see('Posts', 'h1');
    }
}