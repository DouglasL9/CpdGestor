@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul class="list">
        @foreach ($errors->all() as $erro)
            <li>{{$erro}}</li>
        @endforeach
        </ul>
    </div>
@endif

@if(isset($acesso_promotor))
    <form action="{{route('acesso_promotor.update', [$acesso_promotor->id])}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
@else
    <form action="{{route('acesso_promotor.store')}}" method="POST" enctype="multipart/form-data">    
@endif
    @csrf
    <div class="row col-md-12">
        @if(!isset($acesso_promotor))
            {{-- <div class="row"> --}}
                {{-- <div class="col-md-12">
                    <div class="icheck-primary d-inline">
                        <input type="checkbox" id="record-from-database" name="record_from_database">
                            <label for="record-from-database">Cadastrar usuário a partir do banco de dados de funcionários
                        </label>
                    </div>
                </div>
                <hr> --}}
            {{-- </div> --}}
        @endif
        <div class="col-md-4">
            <div class="form-group">
                <label for="nome"><i class="fa-solid fa-signature"></i> Nome completo <span class="text-danger">*</span></label>
                <input type="text" name="nome" class="form-control" id="nome" value="{{(isset($acesso_promotor)) ? $acesso_promotor->nome : old('nome')}}" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="mateusid"><i class="fa-solid fa-fingerprint"></i> Mateus ID <span class="text-danger">*</span> <span class="small text-danger">(Somente números)</span></label>
                <input type="text" name="mateusid" class="form-control" id="mateusid" value="{{(isset($acesso_promotor)) ? $acesso_promotor->mateusid : old('mateusid')}}" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="senha"><i class="fa-solid fa-key"></i> Senha <span class="text-danger">*</span></label>
                <input type="text" name="senha" class="form-control" id="senha" value="{{(isset($acesso_promotor)) ? $acesso_promotor->senha : old('senha')}}" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="numero"><i class="fa-solid fa-key"></i> Numero <span class="text-danger">*</span></label>
                <input type="text" name="numero" class="form-control" id="numero" value="{{(isset($acesso_promotor)) ? $acesso_promotor->numero : old('numero')}}" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="cpf"><i class="fa-solid fa-address-card"></i> CPF <span class="text-danger">*</span></label>
                <input type="text" name="cpf" class="form-control" id="cpf"  value="{{(isset($acesso_promotor)) ? $acesso_promotor->cpf : old('cpf')}}" required
                @if(isset($acesso_promotor) && session()->get('filial')->id != 1)
                    readonly    
                @endif>
            </div>
        </div>
    </div>

    {{-- @if (isset($acesso_promotor))
    <div class="row col-md-12">
        <div class="col-md-4">
            <div class="form-group">
                <label for="data_admissao">Data atualização *</label>
                <input type="date" class="form-control" value="{{ $acesso_promotor->updated_at->format('Y-m-d') }}">
            </div>
        </div>
    </div>
    @endif --}}

    <hr>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-outline-success float-right ml-2">{!!(isset($acesso_promotor)) ? '<i class="fas fa-sync"></i> ATUALIZAR' : '<i class="fas fa-save"></i> SALVAR'!!}</button>
            <a href="{{route('acesso_promotor.index')}}" class="btn btn-outline-danger float-right"><i class="fas fa-undo-alt"></i> CANCELAR</a>
        </div>
    </div>
</form>