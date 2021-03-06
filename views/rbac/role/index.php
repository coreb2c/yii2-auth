<?php

/*
 * This file is part of the CoreB2C project.
 *
 * (c) CoreB2C project <http://github.com/coreb2c>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var $dataProvider array
 * @var $filterModel  coreb2c\auth\models\Search
 * @var $this         yii\web\View
 */


use kartik\select2\Select2;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = Yii::t('auth', 'Roles');
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $this->beginContent('@coreb2c/auth/views/layout.php') ?>

<?php Pjax::begin() ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $filterModel,
    'layout'       => "{items}\n{pager}",
    'columns'      => [
        [
            'attribute' => 'name',
            'header'    => Yii::t('auth', 'Name'),
            'options'   => [
                'style' => 'width: 20%'
            ],
            'filter' => Select2::widget([
                'model'     => $filterModel,
                'attribute' => 'name',
                'data'      => $filterModel->getNameList(),
                'options'   => [
                    'placeholder' => Yii::t('auth', 'Select role'),
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]),
        ],
        [
            'attribute' => 'description',
            'header'    => Yii::t('auth', 'Description'),
            'options'   => [
                'style' => 'width: 55%',
            ],
            'filterInputOptions' => [
                'class'       => 'form-control',
                'id'          => null,
                'placeholder' => Yii::t('auth', 'Enter the description')
            ],
        ],
        [
            'attribute' => 'rule_name',
            'header'    => Yii::t('auth', 'Rule name'),
            'options'   => [
                'style' => 'width: 20%'
            ],
            'filter' => Select2::widget([
                'model'     => $filterModel,
                'attribute' => 'rule_name',
                'data'      => $filterModel->getRuleList(),
                'options'   => [
                    'placeholder' => Yii::t('auth', 'Select rule'),
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]),
        ],
        [
            'class'      => ActionColumn::className(),
            'template'   => '{update} {delete}',
            'urlCreator' => function ($action, $model) {
                return Url::to(['/auth/role/' . $action, 'name' => $model['name']]);
            },
            'options' => [
                'style' => 'width: 5%'
            ],
        ]
    ],
]) ?>

<?php Pjax::end() ?>

<?php $this->endContent() ?>