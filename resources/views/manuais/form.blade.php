@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul class="list">
        @foreach ($errors->all() as $erro)
            <li>{{$erro}}</li>
        @endforeach
        </ul>
    </div>
@endif

@if (isset($manual))
    <form method="POST" action="{{ route('manuais.update', $manual->id) }}" enctype="multipart/form-data">
    @method('PUT')
@else
    <form method="POST" action="{{ route('manuais.store') }}" enctype="multipart/form-data">
@endif
    @csrf
        <div class="row">
            <div class="col-md-5" {{ (!isset($manual)) ? 'hidden' : ''  }}>
                <div class="form-group">
                    <label for="data">Data Atualização</label>
                    <input type="date" name="data" class="form-control" id="data" value="{{(isset($manual)) ? $manual->updated_at : Date('Y-m-d')}}" required>
                    @error('data')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-group">
                    <label for="pdf">Manual <span class="text-danger">*</span></label>
                    <span class="badge badge-info">.PDF</span>
                    <input class="form-control" type="file" name="pdf" accept="application/pdf">
                    @error('pdf')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if (isset($manual) && ($manual->pdf))
                        <br>
                        <a href="{{url('/')}}/storage/{{$manual->pdf}}" target="_blank">
                            <img src="{{url('/')}}/storage/{{$manual->pdf}}" width="150">
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="entrada">Titulo <span class="text-danger">*</span></label>
                    <input type="text" name="titulo" class="form-control" value="{{isset($manual) ? $manual->titulo : old('titulo')}}">
                    @error('entrada')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <div class="form-floating">
                        <label for="observacao">Descrição <span class="text-danger">( Opcional )</span></label>
                        <textarea class="form-control" placeholder="descricao" id="descricao">{{isset($manual) ? $manual->descricao : old('descricao')}}</textarea>
                    </div>

                    @error('observacao')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        
        <span class="text-danger">( * ) Campos Obrigatórios</span>
    </div>

    <hr>
    <div class="ard-footer">

        <div class="text-right mr-4 mb-4">
            <a href="{{route('manuais.index')}}" class="btn btn-outline-danger"><i class="fas fa-undo-alt"></i> CANCELAR</a>
            <button type="submit" class="btn btn-outline-success">{!!(isset($manual)) ? '<i class="fas fa-sync"></i> ATUALIZAR' : '<i class="fas fa-save"></i> SALVAR'!!}</button>
        </div>
    </div>

    {{--  @section('scripts')
    <script>
        $('#tipo').change(function () {
            var select = document.getElementById('tipo');
            var index = select.options[select.selectedIndex].index;
            
            if (index === 1) {
                $('.hora').show();

            }else{
                $('.hora').hide();
            }
        })
    </script>
    @endsection  --}}
