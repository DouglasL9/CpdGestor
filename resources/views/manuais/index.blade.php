@extends('layout.app')

@section('title', 'Manuais')

@section('page-title', 'Manuais')

@section('content')
<link rel="stylesheet" href="_partials/style.css">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-regular fa-rectangle-list"></i> Lista de Manuais </h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a href="{{ route('manuais.create') }}" class="btn btn-md btn-info"><i class="fas fa-plus-circle"></i> Cadastrar Novo Manual</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <div class="row">
                            @foreach ($rows as $row)
                                <div class="col-3">
                                    <div class="card">
                                        <span class="icon">
                                            <i class="fa-regular fa-file-pdf fa-2xl" style="color: #ff0000; font-size: 60px"></i>
                                        </span>
                                        <p>
                                            <h4>
                                                {{$row->titulo}}
                                            </h4>
                                        </p>
                                        
                                        <hr>
                                        <div class="fooer" style="text-align: center">
                                            <div class="dropdown w-100">
                                                <span class="w-100" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
                                                    Ações <i class="fa-solid fa-gear"></i>
                                                </span>
                                                
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                    <a href="{{url('/')}}/storage/{{$row->pdf}}" class="dropdown-item"><button class="btn btn-info btn-sm"> <i class="far fa-eye"></i> </button> Visualizar </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="{{ route('ponto.edite', $row->id) }}" class="dropdown-item"><button class="btn btn-success btn-sm"> <i class="far fa-edit"></i> </button> Editar </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="javascript:void(0)" class="dropdown-item text-danger" onclick="remover({{$row->id}})"><button class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i> </button> Remover </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

{{-- Removendo o registro --}}
<script>
    function remover(manual){
        $confirmacao = confirm('Tem certeza que deseja remover este Manual?');

        if($confirmacao){
            window.location.href = "{{url('/')}}/manuais/"+manual+"/destroy"
        }
    }
</script>
@endsection
