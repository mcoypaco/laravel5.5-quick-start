<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepository;
use App\Http\Requests\User\{ChangePassword, Store as StoreUser, Update as UpdateUser};

class UserController extends Controller
{
    protected $users;

    public function __construct(UserRepository $users) 
    {
        $this->middleware('auth:api')->except(['checkDuplicate', 'store']);

        $this->middleware('client')->only(['checkDuplicate', 'store']);

        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->users()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        return $this->users->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return $this->users->find($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        return $this->users->fill($request, $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        return $this->users->delete($user);
    }

    /**
     * Show the authenticated user.
     * 
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request) 
    {
        return $this->users->authenticated($request->user());
    }

    /**
     * Change user's password.
     * 
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(ChangePassword $request)
    {
        return $this->users->changePassword($request);
    }

    /**
     * Check in the specified resource exists in the storage.
     * 
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkDuplicate(Request $request)
    {
        return $this->users->checkDuplicate($request);
    }

    /**
     * Check if password matches authenticated user's password.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkPassword(Request $request) 
    {
        return $this->users->checkPassword($request);
    }

    /**
     * Search for the specified resource from storage.
     * 
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return $this->users->search($request);
    }
}
