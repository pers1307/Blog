<?php
/**
 * AbstractController.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\controllers;
use KoKoKo\assert\Assert;

abstract class AbstractController
{
    /**
     * @param string $templateFile
     * @param array $params
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

    /**
     * @param string $templateFile
     * @param $params
     *
     * @return array string
     * @throws \InvalidArgumentException
     */
    protected function renderByTwig($templateFile, $params)
    {
        Assert::assert($templateFile, 'templateFile')->notEmpty()->string();
        Assert::assert($params, 'params')->isArray();

        \Twig_Autoloader::register();
        $loader = new \Twig_Loader_Filesystem('views');
        $twig = new \Twig_Environment($loader);
        $templ = $twig->LoadTemplate($templateFile);
        return $templ->render($params);
    }
}