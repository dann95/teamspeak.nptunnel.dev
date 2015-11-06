<?php

namespace NpTS\Http\Controllers\Auth;

use NpTS\Domain\Client\Models\User;
use Validator;
use NpTS\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use NpTS\Domain\Client\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Auth\Guard;


class AuthController extends Controller
{

    private $redirectPath = 'account';
    protected $redirectTo = 'account';

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    private $repository;
    private $guard;
    public function __construct(UserRepositoryContract $repository , Guard $guard)
    {
        parent::__construct();
        $this->middleware('guest', ['except' => ['getLogout','activateUser']]);
        $this->repository = $repository;
        $this->guard = $guard;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'cpassword' =>  ['required','same:password'],
        ], [
            //
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function activateUser($key)
    {
        $user = $this->repository->activateByKey($key);
        if(! $user)
        {
            return view('auth.login')->withErrors(['Ocorreu um erro ao tentar confirmar essa conta!']);
        }
        return redirect()->route('account.index');
    }
}
