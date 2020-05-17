<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Título - Teste PDF</title>
</head>
<body>
    <div class="container">
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
</body>
</html>