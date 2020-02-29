<?php

namespace App\Http\Controllers\Admin;

use App\Portfolio;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PortfoliosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $portfolios = Portfolio::orderBy('updated_at', 'DESC')->get();
        return view('admin.portfolios.index', ['portfolios' => $portfolios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.portfolios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'nullable|image'
        ]);

        $portfolio = Portfolio::add($request->all());
        $portfolio->uploadImage($request->file('image'));
        $portfolio->toggleStatus($request->get('status'));
        $portfolio->toggleFeatured($request->get('is_featured'));

        return redirect()->route('portfolios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $portfolio = Portfolio::find($id);
        return view('admin.portfolios.edit', compact(
            'portfolio'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'nullable|image'
        ]);

        $portfolio = Portfolio::find($id);
        $portfolio->edit($request->all());
        $portfolio->uploadImage($request->file('image'));
        $portfolio->toggleStatus($request->get('status'));
        $portfolio->toggleFeatured($request->get('is_featured'));

        return redirect()->route('portfolios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Portfolio::find($id)->remove();
        return redirect()->route('portfolios.index');
    }
}
