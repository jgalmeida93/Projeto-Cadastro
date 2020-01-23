@extends('layouts.app', ["current" => "produtos"])

@section('body')
<div class="card border">
    <div class="card-body">
        <form action="/produtos/{{$prod->id}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nomeProduto">Nome da categoria</label>
                <input type="text" class="form-control" id="nomeProduto" name="nomeProduto" placeholder="Categoria"
                    value="{{$prod->nome}}">
                <br>
                <label for="qtdEstoque">Estoque</label>
                <input type="text" class="form-control" id="qtdEstoque" name="qtdEstoque" placeholder="Estoque"
                    value="{{$prod->estoque}}">
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
                <input type="text" class="form-control" id="precoProduto" name="precoProduto" placeholder="Categoria"
                    value="{{$prod->preco}}">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <a href="/produtos" class="btn btn-secondary btn-sm" role="button">Cancelar</a>
        </form>
    </div>
</div>
@endsection
