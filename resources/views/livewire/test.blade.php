<div >
    @if($showClientForm)
    <p class="text-xl font-bold mb-10">Cliente seleccionado: {{ $selectedClient['clienteNombre'] ?? '' }}</p>  
    <section class="flex flex-col justify-center"> 
        <h2>Formulario para el cliente: {{ $selectedClient['clienteNombre'] ?? '' }}</h2>
            {{ $this->form }}
        <button wire:click="updateFormClients" class="btn btn-primary mt-2">Actualizar Cliente</button>
    </section>
    @else
    <p class="text-xl font-bold mb-10">Selecciona un cliente</p>
    <section>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @foreach($clients as $client)
                <div wire:click="selectClient('{{ $client->clienteId }}')" class="cursor-pointer aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <img src="{{ asset('storage/' . $client->clienteImg) }}" alt="Logo {{ $client->clienteNombre }}" class="object-fill" />
                </div>
            @endforeach
        </div>

    </section>
    @endif

</div>
