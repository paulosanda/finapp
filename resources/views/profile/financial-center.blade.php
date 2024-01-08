<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tipos de lançamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-8 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-7xl">
                    <form method="post" action="{{ route('financial_center.store') }}">
                        @csrf
                        <div class="text-white">CADASTRAR NOVO TIPO DE LANÇAMENTO</div>
                    <div class="py-1">
                        <span class="px-1 text-sm text-white">Tipo</span>
                        <select name="type" class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2
                                border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white
                                focus:border-gray-600 focus:outline-none">
                            <option value="credit">Crédito</option>
                            <option value="debit">Débito</option>
                        </select>
                    </div>
                        <div class="py-1">
                            <span class="px-1 text-sm text-white">Tipo de lançamento</span>
                            <input type="text"
                                   name="financial_center_name"  class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2
                                border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white
                                focus:border-gray-600 focus:outline-none" required>
                        </div>
                        <button class="mt-3 text-lg font-semibold bg-gray-700 w-full text-white rounded-lg
            px-6 py-3 block shadow-xl hover:text-white hover:bg-black">
                            Criar
                        </button>
                    </form>
                </div>
                <div class="max-w-7xl">
                </br>
                    <hr>
                    <span class="text-white flex">Estes são os tipos de lançamentos que estão cadastrados para você user e descrever seus lançamentos,
                        sejam eles de conta corrente ou de cartão, estas informações são importantes para o sistema poder te auxiliar na análise de suas finanças.</br>
                        Você pode criar novos tipos ou alterar os existentes, mas atenção ao alterar um tipo exitente você estará migrando todos os registros anteriores para este novo tipo.
                    </span>
                    <p></p>
                    <hr>
                    <table class="w-full table-auto text-sm text-white">
                        <thead>
                            <th colspan="2">TIPOS DE LANÇAMENTOS</th>
                            <th></th>
                        </thead>
                        <tr>
                            @foreach($financialCenters as $fc)
                                <td>{{ typeTranslate($fc->type) }}</td>
                                <td>{{ $fc->financial_center_name }}</td>
                                <td><i class="fas fa-edit"></i> </td>
                        </tr>
                        @endforeach


                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
