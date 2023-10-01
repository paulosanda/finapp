<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contas bancárias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('bank_account_register_exec') }}">
                        @csrf
                        @error("bank_name")
                        <div class="mx-auto max-w-lg bg-red-500">
                            <div class="py-1 align-middle">
                                <b class="text-white">Inserir o nome do banco</b>
                            </div>
                        </div>
                        @enderror
                        @error("branch_number")
                        <div class="mx-auto max-w-lg bg-red-500">
                            <div class="py-1 align-middle">
                                <b class="text-white">Inserir agência</b>
                            </div>
                        </div>
                        @enderror
                        @error("account_number")
                        <div class="mx-auto max-w-lg bg-red-500">
                            <div class="py-1 align-middle">
                                <b class="text-white"> Inserir conta</b>
                            </div>
                        </div>
                        @enderror

                        <div class="mx-auto max-w-lg">
                            <div class="py-1">
                                <span class="px-1 text-sm text-white">Banco</span>
                                <input placeholder="" type="text" class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2
                                border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white
                                focus:border-gray-600 focus:outline-none" name="bank_name">
                            </div>
                            <div class="py-1 flex space-x-2"> <!-- Adicionado classe flex e space-x-2 para alinhar horizontalmente -->
                                <div class="w-1/2"> <!-- Dividir o espaço em duas partes iguais -->
                                    <span class="px-1 text-sm text-white">Agência</span>
                                    <input placeholder="" type="text" class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2
                                    border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white
                                    focus:border-gray-600 focus:outline-none" name="branch_number">
                                </div>
                                <div class="w-1/2"> <!-- Dividir o espaço em duas partes iguais -->
                                    <span class="px-1 text-sm text-white">Conta</span>
                                    <input placeholder="" type="text" class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2
                                    border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white
                                    focus:border-gray-600 focus:outline-none" name="account_number">
                                </div>
                            </div>

                            <div class="py-1">
                                <span class="px-1 text-sm text-white">Saldo inicial</span>
                                <input placeholder="" type="number" class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2
                                border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white
                                focus:border-gray-600 focus:outline-none" name="balance">
                            </div>
                            <button class="mt-3 text-lg font-semibold bg-gray-700 w-full text-white rounded-lg
            px-6 py-3 block shadow-xl hover:text-white hover:bg-black">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
