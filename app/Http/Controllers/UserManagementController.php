<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;

class UserManagementController extends Controller
{
    /**
     * user repository
     *
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository;
        $this->middleware('can:Pengguna');
        $this->middleware('can:Pengguna Tambah')->only(['create', 'store']);
        $this->middleware('can:Pengguna Ubah')->only(['edit', 'update']);
        $this->middleware('can:Pengguna Hapus')->only(['destroy']);
    }

    /**
     * showing user management page
     *
     * @return Response
     */
    public function index()
    {
        return view('user-management.users.index', [
            'data' => $this->userRepository->getUsers(),
        ]);
    }

    /**
     * showing add new user page
     *
     * @return Response
     */
    public function create()
    {
        $roleOptions = $this->userRepository->getRoles()->pluck('name', 'id')->toArray();
        return view('user-management.users.form', [
            'roleOptions' => $roleOptions,
            'rolesOptions' => array('active'=>'active','nonatctive'=>'nonatctive'),
        ]);
    }

    /**
     * save new user to db
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->userRepository->create(
            array_merge(
                ['password' => bcrypt($request->password)],
                $request->only(['name', 'email','status'])
            )
        );
        // dd($user->assignRole($request->role));
        $user->assignRole($request->role);
        return redirect('/user-management/users')->with('successMessage', __('Berhasil menambah pengguna'));
    }

    /**
     * showing edit user page
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $roleOptions = $this->userRepository->getRoles()->pluck('name', 'id')->toArray();
        if ($user->roles->count() > 0)
            $user->role = $user->roles[0]->id;
        return view('user-management.users.form', [
            'roleOptions' => $roleOptions,
            'rolesOptions' => array('active'=>'active','nonatctive'=>'nonatctive'),
            'd'           => $user,
        ]);
    }

    /**
     * update user to db
     *
     * @param UserRequest $request
     * @param User $user
     * @return Response
     */
    public function update(UserRequest $request, User $user)
    {
        // dd($request->status);    
        $this->userRepository->update(
            array_merge(
                ['password' => $request->filled('password') ? bcrypt($request->password) : $user->password],
                $request->only(['name', 'email','status'])
            ),
            $user->id
        );
        $user->syncRoles([$request->role]);
        return redirect('/user-management/users')->with('successMessage', __('Berhasil memperbarui pengguna'));
    }

    /**
     * delete user from db
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        $user = $this->userRepository->delete(
            $user->id
        );
        return redirect()->back()->with('successMessage', __('Berhasil menghapus pengguna'));
    }
}
