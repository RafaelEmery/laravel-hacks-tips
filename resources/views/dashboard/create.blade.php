@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            Nova Ordem
        </div>
        <div class="card-body">
            <form action=" {{route('orders.store')}} " method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="status">Status da Ordem</label>
                    <select class="form-control" id="status" name="status">
                        <option></option>
                        <option value="delivered">Enviado</option>
                        <option value="pending">Pendente</option>
                        <option value="cancel">Cancelado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="track_code">Código de Rastreamento</label>
                    <input class="form-control" type="text" id="track_code" name="track_code">
                </div>

                <button type="submit" class="btn btn-success">Criar Ordem</button>
            </form>
            
        </div>
    </div>
</div>
    
@endsection