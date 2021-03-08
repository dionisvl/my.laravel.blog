<?php

namespace Dionisvl\Shop\Http\Controllers\Admin;

use Dionisvl\Shop\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $orders = Order::orderBy('updated_at', 'DESC')->get();
        return view('shop::admin.orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
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
            'title' => 'required'
        ]);

        Order::add($request->all());

        return redirect()->route('orders.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|Response|View
     */
    public function edit(int $id)
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
            'title' => 'required'
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

    public function download(): void
    {
        $orders = Order::orderBy('updated_at', 'DESC')->get();
        //return Excel::download($orders, 'orders_' . date('Y-m-d') . '.xlsx');
        $orders = $orders->toArray();
        $keys = array_keys($orders[0]);

        $alphabet = range('A', 'Z');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($keys as $key_id => $key) {
            $sheet->setCellValue($alphabet[$key_id] . '1', $key);
        }

        foreach ($orders as $order_id => $order) {
            $row_id = $order_id + 2;
            $i = 0;
            foreach ($order as $value_id => $value) {
                $column_id = $alphabet[$i++];
                $sheet->setCellValue($column_id . $row_id, $value);
            }
        }

        $filename = 'orders_' . date('Y-m-d') . '.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename={$filename}");
        $writer->save("php://output");
    }
}
