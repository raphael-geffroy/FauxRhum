<?php

require_once __DIR__.'/vendor/autoload.php';

/*$user = App\Domain\User\User::create(
    \App\Domain\Shared\Uuid::generate(),
    'username',
    'Coucou1234',
    \App\Domain\User\Role::User,
    new \App\Repository\PdoUserRepository()
);

(new \App\Repository\PdoUserRepository())->save($user);*/
$user = (new \App\Repository\PdoUserRepository())->findOneByUsername('username');
var_dump($user->getCredentials()->getHashedPassword()->match('password'));
var_dump($user->getCredentials()->getHashedPassword()->match('Coucou1234'));