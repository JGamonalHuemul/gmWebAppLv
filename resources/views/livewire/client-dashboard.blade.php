<div class="w-full overflow-x-auto">
    @if($showClientDashboard)
        
        <section class="flex flex-col justify-center"> 
            <h2>Panel de control para el cliente: {{ $selectedClient['clienteNombre'] ?? '' }}</h2>
            <!-- Aquí puedes agregar más contenido específico del panel de control del cliente -->
        </section>
        {{-- Tabla de tópicos  --}}
        @livewire(\App\Livewire\DashboardGraph::class)
        <div class="w-full overflow-x-auto">
        <table class="w-full table-fixed divide-y divide-neutral-200 dark:divide-neutral-700">
            <thead class="bg-neutral-50 dark:bg-neutral-800">
                <tr>
                    <th class="w-1/4 px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Tópico</th>
                    <th class="w-1/2 px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Descripción</th>
                    <th class="w-1/4 px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Cant de Respuestas</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-neutral-900 divide-y divide-neutral-200 dark:divide-neutral-700">
                @foreach($topics as $topic)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-neutral-900 dark:text-neutral-100 truncate">{{ $topic->nombreTopico }}</td>
                        <td class="px-6 py-4 text-sm text-neutral-500 dark:text-neutral-400 truncate">{{ $topic->keywordsTopico }}</td>
                        <td class="px-6 py-4 text-sm text-neutral-500 dark:text-neutral-400">{{ $topic->conteoTopico }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
</div>

    @else
        <p class="text-xl font-bold mb-10">Selecciona un cliente</p>
        <section>
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                @foreach($clients as $client)
                    <div wire:click="selectClient('{{ $client->clienteId }}')" 
                        class="cursor-pointer aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                        <img src="{{ asset('storage/' . $client->clienteImg) }}" alt="Logo {{ $client->clienteNombre }}" class="object-fill" />
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</div>
