@extends('layouts.app', ["current" => "produtos"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="/produtos" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nomeProduto">Nome do produto</label>
                    <input type="text" class="form-control" id="nomeProduto" 
                    name="nomeProduto" placeholder="Produto">
                    <br>
                    <label for="qtdEstoque">Quantidade em estoque</label>
                    <input type="number" id="qtdEstoque" name="qtdEstoque" min="0" max="100" maxlength="3" 
                    class="form-control" placeholder="Estoque">
                    <br>
                    <label for="categoria">Categoria</label>
                    <select name="categoria" id="categoria" class="form-control">
                        <option value="">Selecione uma categoria</option>
                        @foreach ($cats as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nome }}</option>
                        @endforeach
                    </select>
                    <br>

                    <label for="precoProduto">Preço</label>
                    <input type="number" class="form-control" id="precoProduto" 
                    name="precoProduto" placeholder="Preço">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <a href="/produtos" class="btn btn-secondary btn-sm" role="button">Cancelar</a>
            </form>
        </div>
    </div>
@endsection