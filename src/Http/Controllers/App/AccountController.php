<?php

namespace Amethyst\Http\Controllers\App;

use Amethyst\Api\Http\Controllers\Controller;
use Amethyst\Managers\UserManager;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * @var \Amethyst\Managers\UserManager
     */
    protected $manager;

    /**
     * Construct.
     */
    public function __construct(UserManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Display current user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        // $this->initialize($request);
        return $this->success(['resource' => $this->manager->serializer->serialize(
            $this->getUser(),
                collect([
                    'id',
                    'avatar',
                    'name',
                    'email',
                    'password',
                    'created_at',
                ])
            )->all(),
        ]);
    }
}
