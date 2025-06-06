<div class="modal fade novo-item" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Novo Equipamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="{{route('filial.item.store')}}" method="POST">
            @csrf
            <div class="row">
                {{--  <div class="col-md-12">  --}}
                <div class="col-6">
                    <div class="form-group">
                        <label for="nome">Tipo Produto *</label>
                        {{-- <input type="text" class="form-control" name="nome" value="{{isset($item) ? $item->nome : old('nome')}}" required> --}}
                        <select class="form-control" name="nome" id="">
                            <option value="">--- selecione ---</option>
                            <optgroup label="CONSULTOR">
                                <option value="consultor-consultor de preço">Consultor de Preço</option>
                            </optgroup>
                            <optgroup label="IMPRESSORA">
                                <option value="impressora-impressora">Impressora</option>
                            </optgroup>
                            <optgroup label="PDV">
                                <option value="pdv-CPU">CPU</option>
                                <option value="pdv-Teclado">Teclado</option>
                                <option value="pdv-Impressora Termica">Impressora Termica</option>
                                <option value="pdv-Gaveta">Gaveta</option>
                                <option value="pdv-Pistola">Pistola</option>
                                <option value="pdv-Leitor">Leitor</option>
                                <option value="pdv-Balanca">Balança</option>
                                <option value="pdv-Maquininha">Maquininha</option>
                            </optgroup>
                            <optgroup label="DESKTOP">
                                <option value="desktop-Monitor">Monitor</option>
                                <option value="desktop-Teclado">Teclado</option>
                                <option value="desktop-Mouse">Mouse</option>
                                <option value="desktop-CPU">CPU</option>
                            </optgroup>
                            <optgroup label="RACK">
                                <option value="rack-patch panel">Patch Panel</option>
                                <option value="rack-switch">Switch</option>
                                <option value="rack-backbone">Backbone</option>
                                <option value="rack-mikrotik">Mikrotik</option>
                                <option value="rack-servidor">Servidor</option>
                            </optgroup>
                            <optgroup label="PAINEL">
                                <option value="painel-Painel Digital">Painel Digital</option>
                                <option value="painel-Impressora Termica">Impressora Termica</option>
                                <option value="painel-Controle">Controles</option>
                            </optgroup>
                            <optgroup label="BALANÇA">
                                <option value="balança-Teclado">Teclado</option>
                                <option value="balança-Prix 5">Balança Prix 5</option>
                                <option value="balança-Prix 6">Balança Prix 6</option>
                                <option value="balança-Celula">Celula</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="form-group">
                        <label for="nome">Marca *</label>
                        <input type="text" class="form-control" name="marca" value="{{isset($item) ? $item->marca : old('marca')}}" required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="nome">Serial *</label>
                        <input type="text" class="form-control" name="serial" value="{{isset($item) ? $item->serial : old('serial')}}" required>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="nome">Preço *</label>
                        <input type="text" class="form-control" name="preco" value="{{isset($item) ? $item->preco : old('preco')}}" required>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        {{--  <label for="active">Ativo *</label>
                        <select name="active" id="active" class="form-control" required>
                            <option value="">Selecione...</option>
                            <option value="1" {{(isset($item) && $item->active == true) ? 'selected' : old('active')}}>SIM</option>
                            <option value="0" {{(isset($item) && $item->active == false) ? 'selected' : old('active')}}>NÃO</option>
                        </select>  --}}
                        <label for="descricao">Descrição *</label>
                        <textarea class="form-control" name="descricao" id="descricao" rows="5">{{isset($item) ? $item->descricao : old('descricao')}}</textarea>
                    </div>
                </div>
            </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Salvar</button>
    </form>
    </div>
    </div>
</div>
</div>
  