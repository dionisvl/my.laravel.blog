<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use App\Models\Incoming;
use Illuminate\Routing\Controller;

class IncomingsController extends Controller
{
    public function index()
    {
        $incomings = Incoming::all();
        return view('admin.incomings.index', ['incomings' => $incomings]);
    }

    public function destroy(int $id): RedirectResponse
    {
        Incoming::find($id)->remove();
        return redirect()->back();
    }
}
