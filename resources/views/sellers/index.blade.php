<x-app-layout>
    <script>
            function resendEmail(id) {
                url = 'email/resend/'+id
                fetch(url)
                .then(response => {
                if (!response.ok) {
                    throw new Error(`Erro HTTP! status: ${response.status}`);
                }
                return response.text();
                })
                .then(data => {
                    alert('E-mail enviado')
                })
                .catch(error => {
                    alert('Falha ao enviar e-mail')
                });
            }
    </script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de vendedores') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <table border=1 cellpadding=15>
                        <th>Vendedor</th>
                        <th>E-mail</th>
                        <th>Vendas</th>
                        <th>E-mail</th><tr>
                        @foreach ($sellers as $seller)
                            <td>{{ $seller->nome }}</td>
                            <td>{{ $seller->email }}</td>
                            <td><a href="{{ route('sellers.show', ['id' => $seller->id]) }}">Visualizar Vendas</a></td>
                            <td><a href="javascript:void(0);" onClick="resendEmail({{ $seller->id }})">Reenviar E-mail</a></td><tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
