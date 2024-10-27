@extends('layout.app')

@section('title', 'Manuais')

@section('page-title', 'Manuais')

@section('content')
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
                            <div class="col">
                                <div class="card card-info">
                                    <div class="card-header">
                                        Configuração do Controle do Painel de Senha
                                    </div>
                                    <div class="card-body" style="text-align: center">
                                        <a href="{{ route('manuais.configuracao-controle') }}" target="_blank">
                                            <i class="fas fa-file-pdf fa-lg mt-4" style="font-size: 50px; color: #ff0000;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card card-info">
                                    <div class="card-header">
                                        Configuração da Impressora
                                    </div>
                                    <div class="card-body" style="text-align: center">
                                        <a href="{{ route('manuais.guia-painel') }}" target="_blank">
                                            <i class="fas fa-file-pdf fa-lg mt-4" style="font-size: 50px; color: #ff0000;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card card-info">
                                    <div class="card-header">
                                        Troca de Ribbon
                                    </div>
                                    <div class="card-body" style="text-align: center">
                                        <a href="{{ route('manuais.troca-ribbon') }}" target="_blank">
                                            <i class="fas fa-file-pdf fa-lg mt-4" style="font-size: 50px; color: #ff0000;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
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
    function remover(ponto, funcionario){
        $confirmacao = confirm('Tem certeza que deseja remover este Ponto?');

        if($confirmacao){
            window.location.href = "{{url('/')}}/ponto/"+ponto+"/destroy"
        }
    }
</script>
@endsection
