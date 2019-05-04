<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\OrderProduct;

class ChartController extends Controller
{
    public function getChartQuantity()
    {
        !isset($_GET['date_format']) ? $date_format = 'months' : $date_format = $_GET['date_format'];

        switch ($date_format) {
            default:
            case 'months':
                for ($m = 1; $m <= 12; $m++) {
                    $labels[] = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                    $quantityChart[] = OrderProduct::orderBy('created_at')->whereMonth('created_at', '=', $m)->sum('quantity');
                }
                break;
            case 'days':
                for ($d = 1; $d <= date('t'); $d++) {
                    $labels[] = $d;
                    $quantityChart[] = OrderProduct::orderBy('created_at')->whereDay('created_at', '=', $d)->sum('quantity');
                }
                break;
            case 'years':
                $date = date('Y');
                for ($i = 0; $i <= 4; $i++) {
                    $labels[] = $date - $i;
                    $quantityChart[] = OrderProduct::orderBy('created_at')->whereYear('created_at', '=', $date - $i)->sum('quantity');
                }
                break;
        }

        return response()->json([
            'quantityChart' => $quantityChart,
            'labels' => $labels
        ]);
    }

    public function getChartProfit()
    {
        isset($_GET['date_format']) ? $date_format = $_GET['date_format'] : $date_format = 'months' ;


        switch ($date_format) {
            default:
            case 'months':
                for ($m = 1; $m <= 12; $m++) {
                    $labels[] = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                    $orderProducts = OrderProduct::orderBy('created_at')->whereMonth('created_at', '=', $m)->get();

                    $profitChart [] = $this->getProfitPrice($orderProducts);
                    $salesChart [] = $this->getPrice($orderProducts);
                }
                break;
            case 'days':
                for ($d = 1; $d <= date('t'); $d++) {
                    $labels[] = $d;
                    $orderProducts = OrderProduct::orderBy('created_at')->whereDay('created_at', '=', $d)->get();

                    $profitChart [] = $this->getProfitPrice($orderProducts);
                    $salesChart [] = $this->getPrice($orderProducts);
                }
                break;
            case 'years':
                $date = date('Y');
                for ($i = 0; $i <= 4; $i++) {
                    $labels[] = $date - $i;
                    $orderProducts = OrderProduct::orderBy('created_at')->whereYear('created_at', '=', $date - $i)->get();

                    $profitChart [] = $this->getProfitPrice($orderProducts);
                    $salesChart [] = $this->getPrice($orderProducts);

                }
                break;
        }


        return response()->json([
            'profitChart' => $profitChart,
            'salesChart' => $salesChart,
            'labels' => $labels
        ]);
    }

    private function getPrice($orderProducts)
    {
        $price = 0;
        foreach ($orderProducts as $orderProduct) {
            $price += $orderProduct->quantity * $orderProduct->product->price;
        }
        return $price;
    }

    private function getProfitPrice($orderProducts)
    {
        $price = 0;
        foreach ($orderProducts as $orderProduct) {
            $price += $orderProduct->quantity * $orderProduct->product->price;
        }

        if ($orderProducts->isNotEmpty()) {
            return $price - $orderProducts[0]->order->shipment->price;
        }

        return $price;
    }
}
