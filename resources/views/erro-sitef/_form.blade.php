@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul class="list">
        @foreach ($errors->all() as $erro)
            <li>{{$erro}}</li>
        @endforeach
        </ul>
    </div>
@endif

@if(isset($erro_sitef))
    <form action="{{route('erro-sitef.update', $erro_sitef->id)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
@else
    <form action="{{route('erro-sitef.store')}}" method="POST" enctype="multipart/form-data">    
@endif
    @csrf

    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <label for="codigo">Código *</label>
                <input type="text" class="form-control" name="codigo" value="{{isset($erro_sitef) ? $erro_sitef->codigo : old('codigo')}}" required>
            </div>
        </div>
        <div class="col-md-9">
            <div class="form-group">
                <label for="titulo">Titulo *</label>
                <input type="text" class="form-control" name="titulo" value="{{isset($erro_sitef) ? $erro_sitef->titulo : old('titulo')}}" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="descricao">Descrição *</label>
                <textarea name="descricao" id="descricao" class="form-control" rows="5">{{isset($erro_sitef) ? $erro_sitef->descricao : ''}}</textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="retentativa">Permite retentativa *</label>
                <select name="retentativa" id="retentativa" class="form-control">
                    <option> Selecine </option>
                    <option value="1" {{isset($erro_sitef) && $erro_sitef->retentativa == 1 ? 'selected' : ''}} > SIM </option>
                    <option value="0" {{isset($erro_sitef) && $erro_sitef->retentativa == 0 ? 'selected' : ''}} > NÃO </option>
                </select>
            </div>
        </div>
    </div>

    <hr>
    <div class="text-right">
        <a href="{{route('erro-sitef.index')}}" class="btn btn-outline-danger"><i class="fas fa-undo-alt"></i> CANCELAR</a>
        <button type="submit" class="btn btn-outline-success">{!!(isset($erro_sitef)) ? '<i class="fas fa-sync"></i> ATUALIZAR' : '<i class="fas fa-save"></i> SALVAR'!!}</button>
    </div>
</form>