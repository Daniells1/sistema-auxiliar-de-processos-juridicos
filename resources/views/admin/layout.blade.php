<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>S.A.P.J</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
       
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('admin.home') }}">Advogados</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
           
            
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.meus-dados') }}">Meus Dados</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Sair</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        @php 

        $usuario = Auth::user();

        @endphp
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            
                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#menu-processos" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-scale-balanced"></i></div>
                               Processos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="menu-processos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('admin.processos.novo') }}">Novo</a>
                                    <a class="nav-link" href="{{ route('admin.processos.buscar') }}">Buscar</a>
                                </nav>
                            </div>

                            @can("adm", $usuario)
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#menu-pessoas" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie"></i></div>
                               Pessoas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="menu-pessoas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('admin.pessoas.autor') }}">Autor</a>
                                    <a class="nav-link" href="{{ route('admin.pessoas.reu') }}">Réu</a>
                                    <a class="nav-link" href="{{ route('admin.pessoas.advogado') }}">Advogado</a>
                                </nav>
                            </div>

                            @endcan

                            @can("adm", $usuario)

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#menu-usuarios" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                               Usuários
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="menu-usuarios" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('admin.usuarios.novo') }}">Novo</a>
                                    <a class="nav-link" href="{{ route('admin.usuarios.buscar') }}">Buscar</a>
                                </nav>
                            </div>

                            @endcan


                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#menu-relatorios" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-database"></i></div>
                               Relatório
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="menu-relatorios" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.relatorio.processo') }}">Processo</a>
                                    <a class="nav-link" href="{{ route('admin.relatorio.advogado') }}">Advogado</a>
                                    <a class="nav-link" href="{{ route('admin.relatorio.autor') }}">Autor</a>
                                </nav>
                            </div>

                        </div>
                    </div>
                   
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 mt-2">
                    @if(Session::has("success") && Session::get("success") != "")
                <div class="alert alert-success">
                    {{ Session::get("success") }}
                </div>
                @endif

                @if(Session::has("error") && Session::get("error") != "")
                <div class="alert alert-danger">
                    {{ Session::get("error") }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-warning">
                   <ul>
                    @foreach($errors->all() as $erro)

                    <li>{{ $erro }}</li>

                    @endforeach
                   </ul>
                </div>

                @endif



                      @yield("conteudo")
                    </div>
                </main>
                <footer class=" bg-light mt-auto p-2">
                    <div class="container-fluid ">
                        <div class="d-flex align-items-center justify-content-center ">
                            <div class="text-muted">Copyright &copy; Advogados</div>
                           
                        </div>
                    </div>
                </footer>
            </div>
        </div>

      <div class="modal fade" id="modal-sistema">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">
                        Meu Modal
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="conteudo-modal">

                    </div>
                </div>
            </div>
        </div>
       </div>


        <script src="{{ asset('js/format-mask.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    </body>
</html>
