<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use App\Criteria\RequestCriteria;
use Response;

class UserController extends InfyOmBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        parent::__construct();
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    	\Session::put("user_back_url",$request->getRequestUri());
        $this->userRepository->pushCriteria(new RequestCriteria($request))->orderBy('id','desc');
        $users = $this->userRepository->paginate(15);

        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $user = $this->userRepository->create($input);

        $user->roles()->attach($input['role_id']);

        Flash::success('新增成功');

        return redirect(session('user_back_url',route('users.index')));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('找不到页面');

            return redirect(session('user_back_url',route('users.index')));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('找不到页面');

            return redirect(session('user_back_url',route('users.index')));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('找不到页面');

            return redirect(session('user_back_url',route('users.index')));
        }

        $input=$request->all();

        $user = $this->userRepository->update($input, $id);

        Flash::success('编辑成功');

        return redirect(session('user_back_url',route('users.index')));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('找不到页面');

            return redirect(session('user_back_url',route('users.index')));
        }

        if($user->employee->isOn()){
            Flash::error('员工在职，删除失败');

            return redirect(session('user_back_url',route('users.index')));
        }

        $this->userRepository->delete($id);

        Flash::success('删除成功');

        return redirect(session('user_back_url',route('users.index')));
    }
}
