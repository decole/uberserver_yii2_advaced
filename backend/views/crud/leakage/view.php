<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleLeakage */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'CRUD Модуль протечки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="module-leakage-view">

    <p>
        <?= Html::a('Назад', ['leakage-crud/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить модуль?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'topic',
            'check_up',
            'check_down',
            'message_info',
            'message_ok',
            'message_warn',
            [
                'label' => 'Тип датчика',
                'value' => function ($model) {
                    return $model->types->name;
                }
            ],
            [
                'label' => 'Место нахождения датчика',
                'value' => function ($model) {
                    return $model->locations->location;
                }
            ],
            [
                'label' => 'Создано',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->created_at, 'dd.MM.yyyy HH:mm:ss');
                }
            ],
            [
                'label' => 'Обновлено',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->updated_at, 'dd.MM.yyyy HH:mm:ss');
                }
            ],
            [
                'label' => 'Сообщать о событиях',
                'value' => function ($model) {
                    return ($model->notifying) ? 'Да' : 'Нет';
                }
            ],
            [
                'label' => 'Активно',
                'value' => function ($model) {
                    return ($model->active) ? 'Да' : 'Нет';
                }
            ],
        ],
    ]) ?>

</div>
