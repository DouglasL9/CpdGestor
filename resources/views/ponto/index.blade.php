@extends('layout.app')

@section('title', 'Pontos')

@section('page-title', 'Pontos')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-regular fa-rectangle-list"></i> Listagem de Pontos</h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a href="{{ route('ponto.create') }}" class="btn btn-md btn-info"><i class="fas fa-plus-circle"></i> NOVO PONTO</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-end">
                        @if ($horas[0] != '00:00:00')
                            <div class="text-right col-sm-3">
                                <div class="text-right info-box bg-success">
                                    <span class="info-box-icon"><i class="far fa-clock fa-lg"></i></span>
                                    <div class="info-box-content">
                                    <span class="info-box-text"> <b>SALDO DE HORAS EXTRAS</b></span>
                                    <span class="info-box-number"><h3><b>{{ $horas[0] }}</b></h3></span>
                                    </div>
                                </div>
                            </div>
                        @elseif ($horas[1] != '00:00:00')
                            <div class="text-right col-md-3">
                                <div class="info-box bg-danger">
                                    <span class="info-box-icon"><i class="fas fa-history fa-lg"></i></span>
                                    <div class="info-box-content">
                                    <span class="info-box-text"><b>SALDO DE HORAS NEGATIVAS</b></span>
                                    <span class="info-box-number"></h4><b>{{ $horas[1] }}</b></h4></span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row" style="overflow-x: auto; overflow-y: auto;">
                        <table id="table_datatable" class="table table-bordered table-striped table-hover table-responsve-xl table-responsve-sm table-responsve-md">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Entrada</th>
                                    <th>Saida P/Almoço</th>
                                    <th>Volta P/Almoço</th>
                                    <th>Saída</th>
                                    <th>Horas Trabalhadas</th>
                                    <th>Hora Extra / Negativa</th>
                                    <th class="text-center" style="width: 10%"><i class="fa-solid fa-gears"></i> Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pontos as $row)
                                <tr style="height: 40px">
                                    <td>{{date('d/m/Y', strtotime($row->data))}}</td>
                                    @if ($row->tipo === 2)
                                        <td colspan="4" class="text-center">
                                            {!!'<span class="badge badge-warning" style="font-size: 15px; width:100%; padding:6px;">DSR</span>'!!}
                                        </td>
                                        @elseif ($row->tipo === 3)
                                        <td colspan="4" class="text-center">
                                            {!!'<span class="badge badge-success" style="font-size: 15px; width:100%; padding:6px;">FOLGA FERIADO</span>'!!}
                                        </td>
                                        @elseif ($row->tipo === 4)
                                        <td colspan="4" class="text-center">
                                            {!!'<span class="badge badge-danger" style="font-size: 15px; width:100%; padding:6px;">DOMINGO</span>'!!}
                                        </td>
                                        @elseif ($row->tipo === 5)
                                        <td colspan="4" class="text-center">
                                            {!!'<span class="badge badge-info" style="font-size: 15px; width:100%; padding:6px;">ATESTADO MÉDICO</span>'!!}
                                        </td>
                                        @else
                                        <td>{{$row->entrada}}</td>
                                        <td>{{$row->entrada_almoco}}</td>
                                        <td>{{$row->saida_almoco}}</td>
                                        <td>{{$row->saida}}</td>
                                        @endif
                                        <td class="text-center">
                                            {{ ($row->tipo != 1) ? '' : $row->horas_trabalhadas }}
                                        </td>
                                        <td class="text-center">
                                            @if($row->horas_extras != '00:00:00')
                                            <h3><span class="badge badge-success" style="width:100%; padding:6px;">+ {{$row->horas_extras}}</span></h3>
                                            @elseif($row->horas_negativas != '00:00:00')
                                            <h3><span class="badge badge-danger" style="width:100%; padding:6px;">- {{$row->horas_negativas}}</span></h3>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                    <a href="{{ route('ponto.show', $row->id ) }}" class="dropdown-item"><button class="btn btn-info btn-sm"> <i class="far fa-eye"></i> </button> Visualizar </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="{{ route('ponto.edite', $row->id) }}" class="dropdown-item"><button class="btn btn-success btn-sm"> <i class="far fa-edit"></i> </button> Editar </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="javascript:void(0)" class="dropdown-item text-danger" onclick="remover({{$row->id}}, {{$funcionario->id}})"><button class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i> </button> Remover </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8"><span class="text-danger">Nenhum registro encontrado</span></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="d-flex float-right">
                        {{$pontos->links()}}
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

<script>
    UTILIZADO NOS DATATABLE 
    $(function () {
          $("#table_datatable").DataTable({
              "responsive": true,
              "lengthChange": false, 
              "autoWidth": true,
              "initComplete": function () {
                  $('div.fg-toolbar:first').append('<span>Titulo</span>');
              },
              language: {
                  lengthMenu: "Exibir _MENU_ records por página",
                  zeroRecords: "Nenhum registro encontrado.",
                  info: "Exibindo página _PAGE_ de _PAGES_",
                  infoEmpty: "Não há registros disponíveis.",
                  infoFiltered: "(Filtrado from _MAX_ total registros)",
                  search: "Buscar",
                  paginate: {
                      previous: "Anterior",
                      next: "Próximo"
                  }
              }
          });
      });
  </script>
@endsection
