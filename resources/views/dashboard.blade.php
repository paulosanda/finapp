<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="mt-8 dark:bg-gray-800 p-4 shadow rounded-lg">
                    <h2 class="text-white text-lg font-semibold pb-4">Contas Bancárias</h2>
                    @if(isset($bankAccounts))
                    <table class="w-full table-auto text-sm">
                        <thead>
                        <tr class="text-sm leading-normal">
                            <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-white border-b border-grey-light">Banco</th>
                            <th class="py-2 px-8 bg-grey-lightest font-bold uppercase text-sm text-white border-b border-grey-light">Saldo</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bankAccounts as $account)
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-2 px-4 text-white border-b border-grey-light">{{ $account->bank_name }}</td>
                                <td class="py-2 px-4 text-white border-b border-grey-light">R$ 0,00</td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    @endif
                </div>

        </div>
    </div>
</x-app-layout>
