<?php

/*
 * This file is part of the Coreb2c project
 *
 * (c) Coreb2c project <http://github.com/coreb2c>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace coreb2c\auth\filters;

use yii\web\NotFoundHttpException;
use yii\base\ActionFilter;

/**
 * BackendFilter is used to allow access only to admin and security controller in frontend when using yii2-auth with
 * Yii2 advanced template.
 *
 * @author Abdullah Tulek <abdullah.tulek@coreb2c.com>
 */
class BackendFilter extends ActionFilter {

    /**
     * @var array
     */
    public $controllers = ['registration'];

    /**
     * @param \yii\base\Action $action
     *
     * @return bool
     * @throws \yii\web\NotFoundHttpException
     */
    public function beforeAction($action) {
        if (in_array($action->controller->id, $this->controllers)) {
            throw new NotFoundHttpException('Not found');
        }

        return true;
    }

}
