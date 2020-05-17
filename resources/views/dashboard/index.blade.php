@extends('layouts.app')

@section('content')

    <div class="container">
        <a href=" {{route('orders.index', ['status' => 'pending'])}} " class="btn btn-primary">Pedidos pendentes</a>
        <a href=" {{route('orders.index', ['status' => 'delivered'])}} " class="btn btn-primary">Pedidos entregues</a>
        <a href=" {{route('orders.index', ['status' => 'cancel'])}} " class="btn btn-primary">Pedidos Cancelados</a>
        <a href=" {{route('orders.index', ['paid' => 1])}} " class="btn btn-primary">Pedidos Pagos</a>
        <a href=" {{route('orders.index')}} " class="btn btn-primary">Limpar filtros</a>
        <a href=" {{route('orders.export')}} " class="btn btn-primary">Gerar PDF</a>
        <hr>

        <table class="table table-bordered">
            <thead>
                <th>Id</th>
                <th>Status</th>
                <th>Pagamento</th>
                <th>Código de entrega</th>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td> {{$order->id}} </td>
                    <td> {{$order->formatted_status}} </td>
                    <td> {{$order->formatted_paid}} </td>
                    <td> {{$order->track_code}} </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection