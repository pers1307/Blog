<?php
/**
 * User.php
 *
 * @category    AutorizationController
 * @package     Blog
 * @subpackage  Controllers
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     MyLicence
 * @version     1.0
 * @link        https://github.com/pers1307/Blog
 */

namespace pers1307\blog\controllers;

use pers1307\blog\models;

require_once 'src/models/User.php';

class AutorizationController
{
    public function autorization()
    {
        $formOnPage = $this->checkOrCreateAutorization();
        $ContentType = 'Autorization';
        if ($formOnPage == 'Welcome') {
            $loginAdmin = $_SESSION['User'];
        } else
            $loginAdmin = '';
        $this->render('views/Template/general.php',$ContentType, $formOnPage,$loginAdmin);
    }

    protected function render($templateFile, $ContentType, $formOnPage, $loginAdmin)
    {
        ob_start();
        ob_implicit_flush(false);
        require $templateFile;
    }

    protected function checkOrCreateAutorization()
    {
        session_start();
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $user = new models\User();
            if ($user->findByCreditionals($_POST['login'], $_POST['password'])) {
                $_SESSION['User'] = $_POST['login'];
                $_SESSION['Password'] = $_POST['password'];
                return 'Welcome';
            } else {
                return 'Error';
            }
        } else {
            return 'Form';
        }
    }
}