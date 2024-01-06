<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lançamentos em conta corrente') }}
        </h2>
    </x-slot>
    @if(isset($transaction))
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="max-w-xl">
                <div class="relative">
                    <button class=" btn-sm absolute right-2 top-2 bg-gray-300 hover:bg-gray-500 text-gray-800 font-bold py-2 px-4 rounded-full"
                            onclick="toggleTableVisibility()">
                        X
                    </button>
                <table class="w-full table-auto text-sm" id="transaction">
                    <thead>
                    <tr class="text-sm leading-normal">
                        <th colspan="4" class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-white border-b border-grey-light">
                            {{  'Lançamento em '. $transaction->bankAccount->bank_name.' realizado' }}
                        </th>
                    </tr>
                    <tr class="text-sm leading-normal">
                        <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-white border-b border-grey-light">Tipo</th>
                        <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-white border-b border-grey-light">Histórico</th>
                        <th class="py-2 px-8 bg-grey-lightest font-bold uppercase text-sm text-white border-b border-grey-light">Valor</th>
                        <th class="py-2 px-2 bg-grey-lightest font-bold uppercase text-sm text-white border-b border-grey-light">Efetivada</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-2 px-4 text-white border-b border-grey-light">{{ $transaction->type }}</td>
                            <td class="py-2 px-4 text-white border-b border-grey-light">{{ $transaction->description }}</td>
                            <td class="py-2 px-4 text-white border-b border-grey-light">{{ formatMoney($transaction->value) }}</td>
                            <td class="py-2 px-4 text-white border-b border-grey-light">{{ efectiveTransaction($transaction->completed) }}</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('bank_account_transaction_store') }}">
                        @csrf
                        <div class="mx-auto max-w-lg">
                            <div class="py-1">
                                <span class="px-1 text-sm text-white">Selecione a conta</span>
                                <select class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2
                                border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white
                                focus:border-gray-600 focus:outline-none" name="bank_account_id">
                                    <option value="">Escolha a conta para os laçamentos</option>
                                    @if($bankAccounts)
                                        @foreach($bankAccounts as $bankAccount)
                                            <option value="{{ $bankAccount->id }}" {{ old('bank_account_id') == $bankAccount->id ? 'selected' : '' }}>
                                                {{ $bankAccount->bank_name." - ".
                                                    $bankAccount->branch_number." - ".
                                                    $bankAccount->account_number}}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('bank_account_id')
                                <div class="py-1">
                                <span class="text-sm bg-red-500">Escolha a conta</span>
                                </div>
                                @enderror
                            </div>
                            <div class="py-1 flex space-x-2">
                                <div class="w-1/2">
                                    <span class="px-1 text-sm text-white">Tipo</span>
                                    <select class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2
                                border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white
                                focus:border-gray-600 focus:outline-none" name="transaction_type" id="transaction_type">
                                        <option value="">Selecione o tipo de operação</option>
                                        <option value="credit" {{ old('transaction_type') == 'credit' ? 'selected' : '' }}>Crédito</option>
                                        <option value="debit" {{ old('transaction_type') == 'debit' ? 'selected' : '' }}>Débito</option>
                                    </select>
                                    @error('transaction_type')
                                    <span class="text-sm bg-red-500">Escolha o tipo</span>
                                    @enderror
                                </div>
                                <div class="w-1/2">
                                    <span class="px-1 text-sm text-white">Data</span>
                                    <input class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2
                                border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white
                                focus:border-gray-600 focus:outline-none" type="date" name="efective_date" value="{{ old('efective_date') }}">
                                    @error('date')
                                    <span class="text-sm bg-red-500">Escolha a data</span>
                                    @enderror
                                    <span class="text-white text-sm">Lançamentos até a data presente serão lançados como realizados com data futura serão lançados como previsto e deverão ser confirmados</span>
                                </div>
                            </div>
                            <div class="py-1">
                                <span class="px-1 text-sm text-white">Selecione a categoria do laçamento</span>
                                <select class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2
                                border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white
                                focus:border-gray-600 focus:outline-none" name="financial_center_id" id="financial_center_id">
                                    <option value="">escolha a categoria do lançamento</option>
                                    @foreach ($financialCenters as $center)
                                        <option value="{{ $center->id }}" data-type="{{ $center->type }}"
                                            {{ old('financial_center_id') == $center->id ? 'selected' : '' }}>
                                            {{ $center->financial_center_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('financial_center_id')
                                <span class="text-sm bg-red-500">Escolha a categoria</span>
                                @enderror
                            </div>
                            <div class="py-1">
                                <span class="px-1 text-sm text-white">Histórico</span>
                                <input class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2
                                border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white
                                focus:border-gray-600 focus:outline-none" type="text" name="description" value="{{ old('description') }}">
                                @error('description')
                                <span class="text-sm bg-red-500">Descreva seu lançamento</span>
                                @enderror
                            </div>
                            <div class="py-1">
                                <span class="px-1 text-sm text-white">Valor</span>
                                <input class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2
                                border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white
                                focus:border-gray-600 focus:outline-none" type="text" name="value" id = "campo"
                                oninput="formatCurrency(this)" maxlength="11">
                                @error('value')
                                <span class="text-sm bg-red-500">Valor obrigatório</span>
                                @enderror
                            </div>
                            <button class="mt-3 text-lg font-semibold bg-gray-700 w-full text-white rounded-lg
            px-6 py-3 block shadow-xl hover:text-white hover:bg-black">
                                Lançar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('transaction_type').addEventListener('change', function () {
            var selectedType = this.value;
            var financialCenterSelect = document.getElementById('financial_center_id');

            // Limpar seleção atual
            financialCenterSelect.innerHTML = '';

            // Adicionar opções filtradas
            @foreach ($financialCenters as $center)
            if ("{{ $center->type }}" === selectedType) {
                var option = document.createElement("option");
                option.value = "{{ $center->id }}";
                option.text = "{{ $center->financial_center_name }}";
                financialCenterSelect.appendChild(option);
            }
            @endforeach
        });

        function toggleTableVisibility() {
            var table = document.getElementById("transaction");
            if (table.style.display === "none" || table.style.display === "") {
                table.style.display = "table";
            } else {
                table.style.display = "none";
            }
        }


    </script>

</x-app-layout>
