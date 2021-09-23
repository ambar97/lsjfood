<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
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
        $this->middleware('can:Role');
        $this->middleware('can:Role Ubah')->only(['edit', 'update']);
    }

    /**
     * showing user management page
     *
     * @return Response
     */
    public function index()
    {
        return view('user-management.roles.index', [
            'data' => $this->userRepository->getRoles(),
        ]);
    }

    public function create()
    {
        $permission = DB::table('permissions')->get();
        // dd($permission);
        return view('user-management.roles.create', [
            'permissions'     => $permission,
            // 'rolePermissions' => $rolePermissions,
        ]);
    }

    public function store(Request $request)
    {
        // $id=Auth::id();
        $role = new Role;
        $role->name = $request->input('name');
        $role->guard_name = 'web';
        $role->save();
        $insert_id = $role->id;
        $permission = $request->input('permissions');
        for ($i=0; $i < count($permission) ; $i++) { 
            DB::table('role_has_permissions')->insert(
            ['permission_id' => $permission[$i], 'role_id' => $insert_id,]
        );

        }
        return redirect('/user-management/roles')->with('successMessage', __('Berhasil menambah data'));
    }

    /**
     * showing edit user management page
     *
     * @return Response
     */
    public function edit(Role $role)
    {
        $role->load(['permissions']);
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        // dd($rolePermissions);
        return view('user-management.roles.form', [
            'd'               => $role,
            'permissions'     => $this->userRepository->getPermissions(),
            'rolePermissions' => $rolePermissions,
        ]);
    }

    /**
     * update role data
     *
     * @param Request $request
     * @param Role $role
     * @return Response
     */
    public function update(Request $request, Role $role)
    {
        $this->userRepository->updateRole($role->id, $request->only(['permissions']));
        return redirect('user-management/roles')->with('successMessage', __('Berhasil memperbarui role'));
    }
}
