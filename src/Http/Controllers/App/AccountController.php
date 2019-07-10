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

    /**
     * Change user password.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function password(Request $request)
    {
        $result = $this->manager->changePassword($this->getUser(), $request->input('password_old'), $request->input('password'));

        if (!$result->ok()) {
            return $this->error(['errors' => $result->getSimpleErrors()]);
        }

        return $this->success();
    }

    /**
     * Change user email.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function email(Request $request)
    {
        $result = $this->manager->requestChangeEmail($this->getUser(), $request->input('email'));

        if (!$result->ok()) {
            return $this->error(['errors' => $result->getSimpleErrors()]);
        }

        return $this->success();
    }

    /**
     * Delete account.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Request $request)
    {
        $result = $this->manager->delete($this->getUser(), $request->input('password', ''));

        if (!$result->ok()) {
            return $this->error(['errors' => $result->getSimpleErrors()]);
        }

        return $this->success();
    }

    /**
     * Change user username.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function username(Request $request)
    {
        $result = $this->manager->update($this->getUser(), new \Railken\Bag(['name' => $request->input('name')]));

        if (!$result->ok()) {
            return $this->error(['errors' => $result->getSimpleErrors()]);
        }

        return $this->success();
    }
}
