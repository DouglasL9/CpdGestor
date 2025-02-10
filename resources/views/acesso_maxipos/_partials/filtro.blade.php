<form action="{{route('acesso_maxipos.index')}}" id="form-funcionario" method="GET">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header font-weight-bold">
                    <div class="row">
                        <div class="col-md-10">
                            <i class="fa-solid fa-filter"></i> FILTRO
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="funcionario"><i class="fa-regular fa-user"></i> FUNCIONÁRIO</label>
                                <input type="text" class="form-control" name="nome_funcionario" value="{{ isset($funcionario) ? $funcionario : '' }}" onchange ="nomeFuncionario()">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="mateusid"><i class="fa-solid fa-fingerprint"></i></i> Mateus ID</label>
                                <input type="number" class="form-control" name="mateusid" value="{{ isset($mateusid) ? $mateusid : '' }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="gmcore"><i class="fa-solid fa-shield-halved"></i> CÓD GMCORE</label>
                                <input type="number" class="form-control" name="gmcore" value="{{ isset($gmcore) ? $gmcore : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <div class="col-md-2 float-right">
                        <button type="submit" class="form-control btn btn-outline-info">Filtrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function nomeFuncionario(){
        $('#form-funcionario').submit()
    }
</script>