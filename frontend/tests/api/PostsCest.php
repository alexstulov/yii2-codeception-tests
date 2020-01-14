<?php namespace frontend\tests;
use frontend\tests\ApiTester;
use frontend\tests\fixtures\PostFixture;
use yii\helpers\Url;

class PostsCest
{
    public function _before(ApiTester $I)
    {
        $I->haveFixtures([
            'post' => [
                'class' => PostFixture::className(),
                'dataFile' => codecept_data_dir() . 'post.php'
            ]
        ]);
    }

    public function testGetAll(ApiTester $I)
    {
        $I->sendGET(Url::to('api/post'));
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([0 => ['title' => 'First Post']]);
    }


}
