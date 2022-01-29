<?php

namespace Dionisvl\Shop\Presenters;

use Dionisvl\Shop\Models\Order;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * HTML or Excel orders list Simple presenter
 */
class OrdersListPresenter
{
    private function getOrders()
    {
        return Order::orderBy('updated_at', 'DESC')->get();
    }

    public function getBladeOrdersList(): array
    {
        return ['orders' => $this->getOrders()];
    }

    public function getExcelOrdersList(): Spreadsheet
    {
        $orders = $this->getOrders()->toArray();

        foreach ($orders as $order_id => $order) {
            foreach ($order as $key => $value) {
                if ($key === 'created_at' || $key === 'updated_at') {
                    $orders[$order_id][$key] = date('Y-m-d h:i:s', strtotime($value));
                }
            }
        }

        //insert headings into array start
        $headings = [array_keys($orders[0])];
        array_splice($orders, 0, 0, $headings);

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
            ->setCreator("Den")
            ->setLastModifiedBy("Dionisvl")
            ->setTitle("My Awesome Orders");
        $spreadsheet->getActiveSheet()->setCellValue('B1','My Awesome Orders');
        $spreadsheet->getActiveSheet()->getStyle('B1')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
        $spreadsheet->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
        $spreadsheet->getActiveSheet()
            ->fromArray(
                $orders,  // The data to set
                NULL,        // Array values with this value will not be set
                'B2'         // Top left coordinate of the worksheet range where
            //    we want to set these values (default is A1)
            );

        return $spreadsheet;
    }
}
