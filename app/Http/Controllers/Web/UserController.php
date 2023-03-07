<?php

namespace App\Http\Controllers\Web;

use App\Forms\UserForm;
use App\Http\Controllers\Controller;
use App\Http\Upload\UploadTrait;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    use UploadTrait, ResetsPasswords;

    private $_formBuilder;

    public function __construct(FormBuilder $builder)
    {
        $this->_formBuilder = $builder;
        $this->middleware('role:super_admin|admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::withTrashed()->orderBy('created_at', 'desc')->get();
            try {
                return DataTables::of($users)
                    ->addIndexColumn()
                    ->addColumn('action', function ($user) {
                        return view('pages.users._actions', compact('user'));
                    })
                    ->addColumn('rule', function ($user) {
                        return view('pages.users._rule', compact('user'));
                    })
                    ->addColumn('picture', function ($user) {
                        return view('pages.users._picture', compact('user'));
                    })
                    ->rawColumns(['action', 'rule', 'picture'])
                    ->make();
            } catch (\Exception $e) {
            }
        }
        return view('pages.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function create(Request $request)
    {
        $form = $this->_getForm($request);
        $user = new User();
        return view('pages.users.create', compact('form', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function store(Request $request)
    {
        $form = $this->_getForm($request);
        $form->redirectIfNotValid();
        $u = $this->_fillUserData($request);
        if (!empty($request->file('picture'))) {
            $this->uploadUserPicture($request, $u);
        }
        $u->save();
        $u->assignRole($request->input('rule'));
        return redirect()->route('user_index')
            ->with(
                'success',
                __('labels.actions.messages.success.created')
            );
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $user = User::with(['cars', 'displacements', 'notices'])->find($id);
        $rank = $user->notices->average('note');
        if (empty($user)) {
            $user = User::withTrashed()->find($id);
            if (empty($user)) {
                return redirect()->route('user_index')
                    ->with(
                        'error',
                        __('labels.actions.messages.error.not_found')
                    );
            }
        }
        return view('pages.users.details', compact('user', 'rank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $user = User::query()->find($id);
        if (empty($user)) {
            $user = User::withTrashed()->find($id);
            if (empty($user)) {
                return redirect()->route('user_index')
                    ->with(
                        'error',
                        __('labels.actions.messages.error.not_found')
                    );
            }
        }
        $form = $this->_getForm($request, $user);
        return view('pages.users.create', compact('form', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $user = User::query()->find($id);
        if (empty($user)) {
            return redirect()->route('user_index')
                ->with(
                    'error',
                    __('labels.actions.messages.error.not_found')
                );
        }
        $form = $this->_getForm($request, $user);
        $form->redirectIfNotValid();
        $user = $this->_fillUserData($request, $user);
        if (!empty($request->file('picture'))) {
            File::delete(public_path('assets/images/users/' . $user->picture));
            $this->uploadUserPicture($request, $user);
        }
        $user->update();
        $user->removeRole($user->getRoleNames()->pluck('name')[0]);
        $user->assignRole($request->input('rule'));
        return redirect()->route('user_index')
            ->with(
                'success',
                __('labels.actions.messages.success.updated')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return Response|mixed
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        if ($request->user()->hasPermissionTo('delete user')) {
            $user = User::query()->find($id);
            if (empty($user)) {
                return redirect()->route('user_index')
                    ->with(
                        'error',
                        __('labels.actions.messages.error.not_found')
                    );
            }
            $user->delete();
            return redirect()->route('product_index')
                ->with(
                    'success',
                    __('labels.actions.messages.success.deleted')
                );
        }
        return redirect()->route('product_index')
            ->with(
                'error',
                __('labels.error.403')
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Request $request request
     *
     * @return Response|mixed
     */
    public function restore(Request $request)
    {
        $id = $request->id;
        if ($request->user()->hasPermissionTo('delete user')) {
            $user = User::withTrashed()->find($id);
            if (empty($user)) {
                return redirect()->route('user_index')
                    ->with(
                        'error',
                        __('labels.actions.messages.error.not_found')
                    );
            }
            $user->restore();
            return redirect()->route('product_index')
                ->with(
                    'success',
                    __('labels.actions.messages.success.restored')
                );
        }
        return redirect()->route('product_index')
            ->with(
                'error',
                __('labels.error.403')
            );
    }

    /**
     * Initialisation of User form
     *
     * @param Request $request
     * @param User $user user model form.
     *
     * @return UserForm|Form
     */
    private function _getForm(Request $request, ?User $user = null)
    {
        $user = $user ?: new User();
        return $this->_formBuilder->create(
            UserForm::class,
            [
                'model' => $user
            ],
            [
                "rule" => $request->user()->roles->pluck('name')[0],
                "auth" => $request->user()->id,
            ]
        );
    }

    /**
     * Fill user's data
     *
     * @param Request $req request
     * @param User $user user
     *
     * @return User
     */
    private function _fillUserData(Request $req, ?User $user = null)
    {
        $u = $user ?: new User();
        $u->first_name = $req->input('first_name');
        $u->last_name = $req->input('last_name');
        $u->phone = $req->input('phone');
        $u->email = $req->input('email');
        if (!empty($req->input('password'))) {
            $u->password = Hash::make($req->input('password'));
        }
        return $u;
    }

    /**
     * Show auth user profile
     *
     * @return Response|mixed
     */
    public function profile()
    {
        return view('pages.users.profil');
    }

    /**
     * Show auth user edit profile page
     *
     * @param Request $request
     *
     * @return Response|mixed
     */
    public function edit_profile(Request $request)
    {
        $user = User::find($request->user()->id);
        $form = $this->_getForm($request, $user);
        $token = $request->route()->parameter('token');
        return view('pages.users.edit', compact('form'));
    }

    /**
     * Change auth user password
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function change_pass(Request $request)
    {
        var_dump($request->only(['email_c', 'current', "password", 'password_confirmed']));
        $user = User::query()->firstWhere('email', '=', $request->input('email_c'));
        if (!empty($user)) {
            if (Hash::check($request->input('current'), $user->password)) {
                if (strcasecmp($request->input('password'), $request->input('password-confirm')) == 0) {
                    $user->update(['password' => Hash::make($request->input('password'))]);
                    $this->guard()->login($user);
                    return redirect()->route('home')->with('success', 'Password changed!');
                }
                return redirect()->back()->with('error', 'password confirmation nor match!');
            }
            return redirect()->back()->with('error', 'Incorrect user credentials!');
        }
        return redirect()->back()->with('error', 'Incorrect user credentials!');
    }

}
