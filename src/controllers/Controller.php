<?php
/**
 * Controller.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\controllers;
use KoKoKo\assert\Assert;

abstract class Controller
{
    /**
     * @param string $templateFile
     * @param string $params
     *
     * @return string
     */
    protected function render($templateFile, $params)
    {
        Assert::assert($templateFile, 'templateFile')->notEmpty()->string();
        Assert::assert($params, 'params')->isArray();

        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);

        require $templateFile;

        return ob_get_clean();
    }
}