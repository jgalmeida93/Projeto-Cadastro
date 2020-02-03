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
                                <input type="text" name="nomeProduto" class="form-control" id="nomeProduto" placeholder="Nome do produto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="precoProduto" class="control-label">Preço</label>
                            <div class="input-group">
                                <input type="number" name="precoProduto" class="form-control" id="precoProduto" placeholder="Preço do produto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qtdEstoque" class="control-label">Quantidade</label>
                            <div class="input-group">
                                <input type="number" name="qtdEstoque" class="form-control" id="qtdEstoque" placeholder="Quantidade">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="categoriaProduto" class="control-label">Categoria</label>
                            <div class="input-group">
                                <select class="form-control" name="categoriaProduto" id="categoriaProduto">

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
            $('#qtdEstoque').val('');
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
                '<button class="btn btn-sm btn-primary mr-1" onclick="editar(' + p.id + ')">Editar</button>' +
                '<button class="btn btn-sm btn-danger ml-1" onclick="remover(' + p.id + ')">Apagar</button>'  + 
            "</td>" +
            "</tr>";

            return linha;    
        }

        function editar(id) {
            $.getJSON('/api/produtos/' + id, function(data) {
            $('#id').val(data.id);
            $('#nomeProduto').val(data.nome);
            $('#precoProduto').val(data.preco);
            $('#qtdEstoque').val(data.estoque);
            $('#categoriaProduto').val(data.categoria_id);
            $('#modalProdutos').modal('show');
                
            })
        }

        function remover(id) {
            $.ajax({
                type: "DELETE",
                url: "/api/produtos/" + id,
                context: this,
                success: function() {
                    linhas = $("#tabelaProdutos>tbody>tr");
                    e = linhas.filter(
                        function(i, element) {
                            return element.cells[0].textContent == id;
                        }
                    );
                    if (e) {
                        e.remove();
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }

        function criarProduto() {
            prod = { 
                nome: $("#nomeProduto").val(), 
                estoque: $("#qtdEstoque").val(), 
                categoria_id: $("#categoriaProduto").val(), 
                preco: $("#precoProduto").val() 
            };
            $.post("/api/produtos", prod, function(data) {
                produto = JSON.parse(data);
                linha = montarLinha(produto);
                $('#tabelaProdutos>tbody').append(linha);
                
            })
        }

        function salvarProduto() {
            prod = { 
                id: $('#id').val(),
                nome: $("#nomeProduto").val(), 
                estoque: $("#qtdEstoque").val(), 
                categoria_id: $("#categoriaProduto").val(), 
                preco: $("#precoProduto").val() 
            };

            $.ajax({
                type: "PUT",
                url: "/api/produtos/" + prod.id,
                context: this,
                data: prod,
                success: function() {
                    console.log('Salvou OK');
                },
                error: function(error) {
                    console.log(error);
                    
                }
            })
        }

        $("#formProduto").submit(
            function(event) {
                event.preventDefault();
                if($('#id').val() != '') { 
                    salvarProduto();
                } else {
                    criarProduto();
                }
                $("#modalProdutos").modal('hide');
            }
        );

        $(function(){
            carregarCategorias();
            carregarProdutos();
        });
    </script>
@endsection