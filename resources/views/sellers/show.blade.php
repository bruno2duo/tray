<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de vendas : ') }} {{ $seller->nome }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <table border=1 cellpadding=15>
                        <th>Valor</th>
                        <th>Data da Venda</th>
                        <th>Comissão Aplicada</th>
                        <th>Comissão Total</th><tr>
                        @foreach ($sales as $sale)
                            <td>R$ {{ $sale->amount }}</td>
                            <td>{{ $sale->sale_date }}</td>
                            <td>{{ $sale->applied_commission }}%</td>
                            <td>R$ {{ $sale->total_commission }}</td><tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
