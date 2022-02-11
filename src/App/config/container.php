<?php

use App\Domain\Article\ArticleRepositoryInterface;
use App\Domain\Article\CategoryRepositoryInterface;
use App\Domain\User\UserRepositoryInterface;
use App\Repository\PdoArticleRepository;
use App\Repository\PdoCategoryRepository;
use App\Repository\PdoUserRepository;
use Framework\Services\Container;

/** @var Container $container */

$container->set(UserRepositoryInterface::class, fn()=>$container->get(PdoUserRepository::class));
$container->set(ArticleRepositoryInterface::class, fn()=>$container->get(PdoArticleRepository::class));
$container->set(CategoryRepositoryInterface::class, fn()=>$container->get(PdoCategoryRepository::class));