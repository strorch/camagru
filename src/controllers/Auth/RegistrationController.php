<?php

declare(strict_types=1);

namespace controllers\Auth;

use core\AbstractController;
use core\Model;
use models\User;

/**
 * Class RegistrationController
 * @package controllers\Auth
 */
class RegistrationController extends AbstractController
{
    private $user;

    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->user = $this->model::getInstance(User::class);
    }

    public function RegistrationCheck()
    {

    }
}
