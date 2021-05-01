@extends('layout.template')

@section('title', 'Nova Aula')
@section('container')
    <form action="/aulas" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="materia" class="form-label">Matéria</label>
                    <input type="text" class="form-control" id="descricao" name="descricao">
                    <br>
                    <label for="dia" class="form-label">Dia</label>
                    <select name="dia" class="form-control" id="dia">
                    @foreach($dias as $dia)
                        <option value="{{$dia}}">{{$dia}}</option>
                    @endforeach
                    </select>
                    <br>
                    <label for="horario" class="form-label">Horario</label>
                    <select name="horario" class="form-control" id="horario">
                    @foreach($horarios as $horario)
                        <option value="{{$horario}}">{{$horario}}</option>
                    @endforeach
                    </select>
                </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="/aulas" class="btn btn-danger">Cancelar</a>
    </form>
@endsection
    
            
                
