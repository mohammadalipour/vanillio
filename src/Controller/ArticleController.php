<?php
declare(strict_types=1);

namespace App\Controller;

use App\Repository\ArticleRepository;
use Exception;

class ArticleController
{
    private ArticleRepository $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function index()
    {
        $response = $this->repository->findAll();

        echo json_encode($response);
    }
}