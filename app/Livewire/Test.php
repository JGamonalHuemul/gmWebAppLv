<?php

namespace App\Livewire;

use App\Models\GmCliente;
use Filament\Forms\Components\FileUpload;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;

class Test extends Component implements HasSchemas
{
    use InteractsWithSchemas;
    public $clients;
    public $selected;
    public $showClientForm = false;
    public $selectedClient;
    public ?array $data = [];

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('clienteNombre')
                    ->required()
                    ->label('Nombre del cliente'),
                FileUpload::make('clienteImg')
                    ->image()
                    ->disk('public')
                    ->maxSize(1024)
                    ->required()
                    ->label('Imagen del cliente'),
                // ...
            ])
            ->statePath('data');
    }

    public function updateFormClients(): void
    {
        $client = GmCliente::find($this->selectedClient->clienteId);
        $img = array_first($this->data['clienteImg']);
        $path = $img->store('logos','public');
        $client->update(['clienteImg' => $path]);
        $client->update(['clienteNombre' => $this->data['clienteNombre']]);
        Notification::make()
            ->title('Cliente actualizado')
            ->success()
            ->send();
        
    }

    public function updating($property, $value)
    {
        // $property: The name of the current property being updated
        // $value: The value about to be set to the property

        if ($property === 'selected') {
            $this->selectedClient = GmCliente::find($value);
            $this->form->fill([
                'clienteNombre' => $this->selectedClient->clienteNombre,
                'clienteImg' => 'storage/' . $this->selectedClient->clienteImg,
            ]);
        }
    }
    
    public function selectClient($clientId)
    {
        $this->selected = $clientId;
        // $this->selectedClient = GmCliente::find($clientId);
        // $this->form->fill($this->selectedClient->toArray());
        $this->updating('selected', $clientId);
        $this->showClientForm = true;
    }

    public function mount(): void
    {
        $this->clients = GmCliente::all();
        $this->form->fill();
    }


    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.test');
    }
}
