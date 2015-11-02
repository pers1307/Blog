<?php
/**
 * Controller.php
 *
 * @category    Controller
 * @package     Blog
 * @subpackage  Controllers
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @version     2.0
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\controllers;

abstract class Controller
{
    protected function render($templateFile, $params)
    {
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);

        require $templateFile;

        return ob_get_clean();
    }
}