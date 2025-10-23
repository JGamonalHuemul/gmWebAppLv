<div class="relative w-full overflow-x-auto">
    {{-- <div class="w-full flex items-center justify-center bg-black/20 z-50">
        <div class="w-16 h-16 rounded-full border-4 border-dashed border-blue-500 animate-spin"></div>
    </div> --}}
    @if($showClientDashboard)
        
        <section class="flex justify-between items-center mb-4"> 
            <h2>Panel de control para el cliente: {{ $selectedClient['clienteNombre'] ?? '' }}</h2>
            <!-- Aquí puedes agregar más contenido específico del panel de control del cliente -->
            <button wire:click="goBack" class="border-2 border-blue-600 hover:border-blue-800 rounded-full"> 
                <x-letsicon-back class="h-10 w-10 text-blue-600 hover:text-blue-800"/>
            </button>
        </section>

        <section class="w-full">
            {{ $this->form }}
        </section>
        {{-- Tabla de tópicos  --}}
        <section class="my-6 grid auto-rows-min gap-4 md:grid-cols-2">
            @livewire(\App\Livewire\DashboardGraph::class, ['clientId' => $selectedClient['clienteId'] ?? '', 
                                                            'selectedTime' => $data['selectedTime'] ?? 'mensual', 
                                                            'startDate' => $data['startDate'] ?? null, 
                                                            'endDate' => $data['endDate'] ?? null, 
                                                            'selectedBranch' => $data['selectedBranch'] ?? null,])   
            @livewire(\App\Livewire\EmotionsWidget::class, ['clientId' => $selectedClient['clienteId'] ?? ''])

        </section>
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

    @else
        <p class="text-xl font-bold mb-10">Selecciona un cliente</p>
        <p class="text-sm text-neutral-500 dark:text-neutral-400">Para ver el panel de control, primero selecciona un cliente de la lista a continuación.</p>
        {{-- Cargando --}}

        <section >
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
