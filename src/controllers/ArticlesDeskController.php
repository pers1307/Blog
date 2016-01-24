<?php
/**
 * ArticlesDeskController.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/Blog_v_2.0
 */

namespace pers1307\blog\controllers;

use pers1307\blog\exception\InvalidAutorizationException;
use Symfony\Component\HttpFoundation\Response;
use pers1307\blog\repository\ArticleRepository;
use pers1307\blog\service\Autorization;
use pers1307\blog\service\Log;
use KoKoKo\assert\Assert;

class ArticlesDeskController extends AbstractController
{
    public function findAllAction()
    {
        try {
            if (!Autorization::getInstance()->checkAutorization()) {
                throw new InvalidAutorizationException(
                    'У вас нет доступа к этой странице. Пожалуйста, авторизируйтесь.'
                );
            }

            $article = new ArticleRepository();
            $articles = $article->findAll();
            $params = [
                'articles' => $articles,
                'forContent' => 'articleDesk.html'
            ];

            $response = new Response(
                'Content',
                Response::HTTP_OK,
                ['content-type' => 'text/html']
            );
            $response->setContent($this->renderByTwig('layoutFilled.html', $params));

            return $response;
        } catch (InvalidAutorizationException $exception) {
            $params = [
                'forContent' => 'template/alert.html',
                'message' => $exception->getMessage()
            ];

            Log::getInstance()->addError(
                'Исключение в ArticlesDeskController->findAllAction : ' . $exception->getMessage()
            );

            $response = new Response(
                'Content',
                Response::HTTP_OK,
                ['content-type' => 'text/html']
            );
            $response->setContent($this->renderByTwig('layoutFilled.html', $params));

            return $response;
        }
    }

    /**
     * @param int $id
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function deleteArticle($id)
    {
        try {
            $id = Assert::assert($id, 'id')->digit()->toInt()->get();
            $articles = new ArticleRepository();
            $articles->deleteById($id);
        } catch (\Exception $exception) {
            Log::getInstance()->addError(
                'Исключение в ArticlesDeskController->deleteArticle : ' . $exception->getMessage()
            );

            return 'ArticleNotDelete';
        }

        return 'ArticleDelete';
    }
}