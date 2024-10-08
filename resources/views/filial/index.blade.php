@extends('layout.app')

@section('title', 'Filial')

@section('page-title', 'Filial')

@section('content')
    

    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-eye"></i> Visualização</h3>
                    @if (auth()->user()->funcionario->superadmin)    
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <a href="{{route('filial.create')}}" class="btn btn-md btn-info">NOVO FILIAL</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="callout callout-info">
                                <b>Código: </b> SM{{($filial->codigo) ?? '-'}}<br> 
                                <b>Nome Fantasia:</b> {{$filial->nome_fantasia}}<br>
                                <b>Razão Social:</b> {{$filial->razao_social}}<br>
                                <b>CNPJ: </b> <span class="cnpj-view">{{$filial->cnpj}}</span><br>
                                <b>Endereço: </b> 
                                    {{$filial->logradouro}},
                                    Nº {{$filial->numero}}, {{($filial->complemento) ? '{$filial->logradouro} ,' : ''}}
                                    {{$filial->bairro}}, <span class="cep-view">{{$filial->cep}}</span>, {{$filial->cidade}} - {{$filial->uf}}

                            </div>
                            <div class="callout callout-info">
                                <b>Telefone: </b> {{($filial->telefone) ?? '-'}}<br>
                                <b>E-mail SAC: </b> {{($filial->email) ?? '-'}}<br>
                                <b>E-mail Financeiro: </b> {{($filial->email_financeiro) ?? '-'}}<br>
                                <b>E-mail Comercial: </b> {{($filial->email_comercial) ?? '-'}}<br>
                                <b>Site: </b> <a href="{{($filial->site) ?? '-'}}" target="_blank" style="text-decoration:none; color:blue;"> {{($filial->site) ?? '-'}}</a> <br>
                                <b>Instagram: </b> <a href="{{($filial->instagram) ?? '-'}}" target="_blank" style="text-decoration:none; color:blue;"> {{$instagram}} </a>  <br>
                            </div>
                        </div>
                        <div class="col-md-6 p-2 text-center">
                            @if(isset($filial) && $filial->logo)
                                {{-- <img class="img-fluid" src="{{asset('storage/'.$filial->logo)}}" width="500" alt="{{mb_strtoupper($filial->nome)}}" title="{{mb_strtoupper($filial->nome)}}"> --}}

                                <img class="img-fluid" src="{{url('/')}}/storage/{{$filial->logo}}" width="500" alt="{{mb_strtoupper($filial->nome)}}" title="{{mb_strtoupper($filial->nome)}}">
                            @else
                                <span class="badge badge-secondary">Não existe logotipo cadastrado</span>
                            @endif
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="col-md-12">
                            @if(auth()->user()->filiais()->where('filial_id', session()->get('filial')->id)->where('superadmin', true)->first()) 
                                <a href="{{route('filial.edit', $filial->id)}}" class="btn btn-outline-success float-right"><i class="fas fa-edit"></i> Editar</a>
                            @endif 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.cnpj-view').mask('00.000.000/0000-00')
            $('.cep-view').mask('00.000-000')
        })
    </script>
@endsection