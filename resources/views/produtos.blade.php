@extends('layouts.app', ["current" => "produtos"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de produtos</h5>
            <table class="table table-ordered table-hover" id="tabelaProdutos">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Departamento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>

            </table>

        </div>

        <div class="card-footer">
            <button class="btn btn-sm btn-primary" onclick="novoProduto()">Novo produto</button>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalProdutos">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formProduto">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo produto</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <div class="form-group">
                            <label for="nomeProduto" class="control-label">Nome do produto</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nomeProduto" placeholder="Nome do produto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="precoProduto" class="control-label">Preço</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="precoProduto" placeholder="Preço do produto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qtdProduto" class="control-label">Quantidade</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="qtdProduto" placeholder="Quantidade">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="categoriaProduto" class="control-label">Categoria</label>
                            <div class="input-group">
                                <select class="form-control" id="categoriaProduto">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
                        <button type="cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection

@section('javascript')
    <script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

        function novoProduto() {
            $('#nomeProduto').val('');
            $('#precoProduto').val('');
            $('#qtdProduto').val('');
            $('#modalProdutos').modal('show');
        }

        function carregarCategorias() {
            
        $.getJSON('/api/categorias', function(data) {
            for(i = 0; i < data.length; i++) {
                opt = '<option value="' + data[i].id + '">' + data[i].nome + '</option>';
                $('#categoriaProduto').append(opt);
            }
        });
        }

        function carregarProdutos() {
            $.getJSON('/api/produtos', function(produtos) {
                for(i = 0; i < produtos.length; i++) {
                    linha = montarLinha(produtos[i]);
                    $('#tabelaProdutos>tbody').append(linha);
                }
            })
        }

        function montarLinha(p) {
            const linha = "<tr>" + 
            "<td>" + p.id + "</td>" +
            "<td>" + p.nome + "</td>" +
            "<td>" + p.estoque + "</td>" +
            "<td>" + p.preco + "</td>" +
            "<td>" + p.categoria_id + "</td>" +
            "<td>" + 
                '<button class="btn btn-sm btn-primary mr-1">Editar</button>' +
                '<button class="btn btn-sm btn-danger ml-1">Apagar</button>'  + 
            "</td>" +
            "</tr>";

            return linha;    
        }

        $(function(){
            carregarCategorias();
            carregarProdutos();
        });
    </script>
@endsection