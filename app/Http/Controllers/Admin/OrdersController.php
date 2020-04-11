<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = Order::orderBy('updated_at', 'DESC')->get();
        return view('admin.orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.orders.create');
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
            'title' => 'required'
        ]);

        $order = Order::add($request->all());

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
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
        $order = Order::find($id);
        return view('admin.orders.edit', compact(
            'order'
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
     * @return Response
     */
    public function destroy($id)
    {
        Order::find($id)->remove();
        return redirect()->route('orders.index');
    }

    public function download()
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
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename={$filename}");
        $writer->save("php://output");
    }
}
