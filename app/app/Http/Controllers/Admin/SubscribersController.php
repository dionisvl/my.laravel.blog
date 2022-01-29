<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscription;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View|Response
     */
    public function index()
    {
        $subs = Subscription::all();

        return view('admin.subs.index', ['subs'=>$subs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|Response
     */
    public function create()
    {
        return view('admin.subs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required|email|unique:subscriptions'
        ]);

        Subscription::add($request->get('email'));

        return redirect()->route('subscribers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Subscription::find($id)->delete();
        return redirect()->route('subscribers.index');
    }
}
