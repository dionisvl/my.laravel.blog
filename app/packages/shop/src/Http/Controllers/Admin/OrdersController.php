<?php

declare(strict_types=1);

namespace Dionisvl\Shop\Http\Controllers\Admin;

use Dionisvl\Shop\Models\Order;
use Dionisvl\Shop\Presenters\OrdersListPresenter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $data = (new OrdersListPresenter())->getBladeOrdersList();
        return view('shop::admin.orders.index', $data);
    }

    /**
     * Excel orders list download.
     *
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function downloadExcelOrdersList(): void
    {
        $spreadsheet = (new OrdersListPresenter())->getExcelOrdersList();

        $filename = 'orders_' . date('Y-m-d') . '.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename={$filename}");
        $writer->save("php://output");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('shop::admin.orders.create');
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

        Order::add($request->all());

        return redirect()->route('orders.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $order = Order::find($id);
        return view('shop::admin.orders.edit', compact(
            'order'
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

        $order = Order::find($id);
        $order->edit($request->all());

        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Order::find($id)->remove();
        return redirect()->route('orders.index');
    }

}
