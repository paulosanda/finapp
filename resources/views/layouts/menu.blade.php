<nav x-data="{ open: false }" class="bg-gray-500 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">

    <aside class="bg-gray-800 text-white w-64 min-h-screen p-4">
        <nav>
            <ul class="space-y-2">
                <div class="flex items-center justify-between p-2 hover:bg-gray-700">
                <a href="{{ route('dashboard') }}"><i class="fas fa-home mr-2 text-xs"></i>Dashboard</a>
                </div>
                <li class="opcion-con-desplegable">
                    <div class="flex items-center justify-between p-2 hover:bg-gray-700">
                        <div class="flex items-center">
                            <i class="fas fa-user mr-2"> </i>
                            <span>Perfil</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                    <ul class="desplegable ml-4 hidden">
                        <li>
                            <a href="{{ route('financial_center.index') }}" class="block p-2 hover:bg-gray-700 flex items-center">
                                <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                Tipos de lançamentos
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit')  }} " class="block p-2 hover:bg-gray-700 flex items-center">
                                <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                Editar
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block p-2 hover:bg-gray-700 flex items-center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-chevron-left mr-2 text-xs"></i>
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="opcion-con-desplegable">
                    <div class="flex items-center justify-between p-2 hover:bg-gray-700">
                        <div class="flex items-center">
                            <i class="fas fa-money-check-alt mr-2"></i>
                            <span>Contas bancárias</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                    <ul class="desplegable ml-4 hidden">
                        <li>
                            <a href="{{ route('bank_account_register')  }} " class="block p-2 hover:bg-gray-700 flex items-center">
                                <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                Registrar conta
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('bank_account_transaction_create') }}" class="block p-2 hover:bg-gray-700 flex items-center">
                                <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                Registrar lançamentos
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block p-2 hover:bg-gray-700 flex items-center">
                                <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                Facturas
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="opcion-con-desplegable">
                    <div class="flex items-center justify-between p-2 hover:bg-gray-700">
                        <div class="flex items-center">
                            <i class="fas fa-chart-bar mr-2"></i>
                            <span>Informes</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                    <ul class="desplegable ml-4 hidden">
                        <li>
                            <a href="#" class="block p-2 hover:bg-gray-700 flex items-center">
                                <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                Presupuestos
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block p-2 hover:bg-gray-700 flex items-center">
                                <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                Informe médico
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="opcion-con-desplegable">
                    <div class="flex items-center justify-between p-2 hover:bg-gray-700">
                        <div class="flex items-center">
                            <i class="fas fa-file-alt mr-2"></i>
                            <span>Documentación</span>
                        </div>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                    <ul class="desplegable ml-4 hidden">
                        <li>
                            <a href="#" class="block p-2 hover:bg-gray-700 flex items-center">
                                <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                Firmas pendientes
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block p-2 hover:bg-gray-700 flex items-center">
                                <i class="fas fa-chevron-right mr-2 text-xs"></i>
                                Documentos
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Agrega más enlaces para la navegación lateral -->
            </ul>
        </nav>
    </aside>

    <!-- Contenido principal -->
    <main class="container mx-auto p-4">

    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Obtener todas las opciones principales con desplegables
            const opcionesConDesplegable = document.querySelectorAll(".opcion-con-desplegable");

            // Agregar evento de clic a cada opción principal
            opcionesConDesplegable.forEach(function (opcion) {
                opcion.addEventListener("click", function () {
                    // Obtener el desplegable asociado a la opción
                    const desplegable = opcion.querySelector(".desplegable");

                    // Alternar la clase "hidden" para mostrar u ocultar el desplegable
                    desplegable.classList.toggle("hidden");
                });
            });
        });
    </script>
</nav>
