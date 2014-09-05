<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;

class UsersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('pages.users.index');
    }

    public function datatable() {
        return Datatables::of(User::with('role'))->make(true);
    }

    public function dashboard() {
        return view('pages.users.dashboard');
    }

    public function changepassword() {
        return view('pages.users.change-password');
    }

    public function updatePassword($userId, ChangePasswordRequest $request) {

        $currentUser = Auth::user();

        if (\Hash::check($request->password_old, $currentUser->password)) {
            $currentUser->password = \Hash::make($request->password);
            $currentUser->save();
            return redirect("/users/{$userId}/passwordchanged");
        } else {
            return redirect("/users/{$userId}/changepassword")
                            ->withErrors(['password_old' => 'Incorrect Password'])
                            ->withInput();
        }
    }

    public function changePasswordSuccess() {
        return view('pages.users.change-password-success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
