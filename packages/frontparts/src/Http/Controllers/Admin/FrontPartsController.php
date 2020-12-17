<?php

namespace Dionisvl\FrontParts\Http\Controllers\Admin;

use Dionisvl\FrontParts\Models\FrontPart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class FrontPartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $frontparts = FrontPart::orderBy('updated_at', 'DESC')->get();
        return view('frontparts::admin.frontparts.index', ['frontparts' => $frontparts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('frontparts::admin.frontparts.create');
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
            'title' => 'required',
        ]);

        $request->merge([
            'status' => $request->has('status'),
        ]);

        FrontPart::add($request->all());

        return redirect()->route('frontparts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|Response|View
     */
    public function edit(int $id)
    {
        $frontpart = FrontPart::find($id);
        return view('frontparts::admin.frontparts.edit', compact(
            'frontpart'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $frontpart = FrontPart::find($id);

        $request->merge([
            'status' => $request->has('status'),
        ]);

        $frontpart->edit($request->all());

        return redirect()->route('frontparts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        FrontPart::find($id)->remove();
        return redirect()->route('frontparts.index');
    }
}
