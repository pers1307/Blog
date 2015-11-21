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
     * @param Array $params
     *
     * @return string
     * @throws \InvalidArgumentException
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


    protected function renderByTwig($templateFile, $params)
    {
        Assert::assert($templateFile, 'templateFile')->notEmpty()->string();
        Assert::assert($params, 'params')->isArray();

        \Twig_Autoloader::register();
        $loader = new \Twig_Loader_Filesystem('views/twig');
        $twig = new \Twig_Environment($loader);
        $templ = $twig->LoadTemplate($templateFile);
        return $templ->render($params);
    }
}