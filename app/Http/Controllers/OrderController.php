<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Repositories\OrderRepository;
use PDF;

class OrderController extends Controller
{
    public function index()
    {      
        $orders = Order::where(function($query) {
            
            if (request()->get('status')) {
                $query->status(request()->get('status'));
            }

            /*
            if (request()->get('status') == 'pending') {
                $query->pending();
            }
            if (request()->get('status') == 'delivered') {
                $query->delivered();
            }
            */
            
            if (request()->get('paid') == 1) {
                $query->paid();
            }
            
        })->get();
        
        /*
        $orders = Order::delivered()->get();
        $orders = Order::pending()->get();
        */

        /*
        $orders = Order::all();

        if (request()->get('status')) {
            switch(request()->get('status')) {

                case 'delivered':
                    $orders = $orders->where('status', 'delivered');
                break;

                case 'pending':
                    $orders = $orders->where('status', 'pending');
                break;
            }
        }

        if (request()->get('paid') == 1) {
            $orders = $orders->where('paid', 1);
        }
        */

        return view('dashboard.index', compact('orders'));
    }

    public function create() 
    {
        return view('dashboard.create');
    }

    public function store(OrderRequest $request) 
    {   
        $order = Order::create($request->all());

        return redirect(route('orders.index'));
    }

    public function all(OrderRepository $repository)  
    {
        return $repository->listAll();
    }

    public function export()
    {
        $orders = Order::all();
        $pdf = PDF::loadview('pdf/orders', compact('orders'));

        return $pdf->download('orders_report.pdf');
    }
}
