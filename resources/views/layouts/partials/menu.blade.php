<li class="nav-item">
    <a class="nav-link" href="{{ route('mediciones.index') }}">Estacion de irradiancia</a>
</li>
<li class="nav-item" style="display: none;" >
    <a class="nav-link" href="#">Doctores</a>
</li>
<li class="nav-item" style="display: none;" >
    <a class="nav-link" href="#">Reportes</a>
</li>
<li class="nav-item dropdown" >
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       Mapa de radiación solar 
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item " href="{{ route('mapas.mensual') }}">Mensual</a>
        <a class="dropdown-item" href="{{ route('mapas.anual') }}">Anual</a>
    </div>
</li>
<li class="nav-item dropdown" style="display: none;">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       Administacion 
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item " href="#">Fabricantes</a>
        <a class="dropdown-item" href="#">Clientes</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item disabled" style="display: none;" href="#">Unidades de carga</a>
        <a class="dropdown-item disabled" href="#">Lote presentacion</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item disabled" href="#">Documentos</a>
        <a class="dropdown-item disabled" href="#">Reactivos</a>
    </div>
</li>
<li class="nav-item" style="display: none;">
    <a class="nav-link disabled" href="#">Disabled</a>
</li>