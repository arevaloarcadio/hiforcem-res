@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading rotulo">
            <h3 class="panel-title">Nueva Etiqueta</h3>
        </div>
        <div class="panel-body">

            <form action="{{ route('printPegatina') }}" method="post" role="form">
                <div class="form-group">
                    <label for="forjado">Forjado</label>
                    <input type="text" id="forjado" name="forjado" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <input type="text" id="tipo" name="tipo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="medida">Medida</label>
                    <input type="text" id="medida" name="medida" class="form-control">
                </div>
                <div class="form-group">
                    <label for="unidades">Unidades</label>
                    <input type="text" id="unidades" name="unidades" class="form-control">
                </div>
                <div class="form-group">
                    <label for="cliente">Cliente</label>
                    <input type="text" id="cliente" name="cliente" class="form-control">
                </div>
                <div class="form-group">
                    <label for="obra">Obra</label>
                    <input type="text" id="obra" name="obra" class="form-control">
                </div>
                <div class="form-group">
                    <label for="planta">Planta</label>
                    <input type="text" id="planta" name="planta" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Imprimir etiquetas</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection