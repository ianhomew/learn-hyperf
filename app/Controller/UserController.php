<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use App\Services\UserService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController()
 *
 * Class UserController
 * @package App\Controller
 */
class UserController extends AbstractController
{

    /**
     * @Inject()
     * @var UserService
     */
    private $userService;

    public function index()
    {
        return $this->userService->register();
    }
}
