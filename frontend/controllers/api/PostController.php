<?php
namespace frontend\controllers\api;

use yii\rest\ActiveController;

class PostController extends ActiveController
{
    public $modelClass = 'common\models\Post';
}