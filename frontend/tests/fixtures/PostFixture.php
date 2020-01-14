<?php
namespace frontend\tests\fixtures;

use yii\test\ActiveFixture;

class PostFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Post';
    public $dataFile = '@frontend/tests/_data/post.php';
}