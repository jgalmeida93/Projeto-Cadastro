<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" 
    data-target="#navbar" aria-controls="navbar" aria-expanded="false" 
    aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav mr-auto">
        <li @if($current == "home") class="nav-item active" @else class="nav-item" @endif>
          <a class="nav-link" href="/">Home<span class="sr-only">(página atual)</span></a>
        </li>

        <li @if($current == "produtos") class="nav-item active" @else class="nav-item" @endif>
          <a class="nav-link" href="/produtos">Produtos<span class="sr-only">(página atual)</span></a>
        </li>

        <li @if($current == "categorias") class="nav-item active" @else class="nav-item" @endif">
          <a class="nav-link" href="/categorias">Categorias<span class="sr-only">(página atual)</span></a>
        </li>
        
      </ul>
    </div>
  </nav>