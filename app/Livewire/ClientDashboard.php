<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GmCliente;
use App\Models\GmTopico;

class ClientDashboard extends Component
{
    public $clients;
    public $selected;
    public $selectedClient;
    public $topics;
    public $showClientDashboard = false;


    public function updating($property, $value)
    {
        // $property: The name of the current property being updated
        // $value: The value about to be set to the property

        if ($property === 'selected') {
            $this->selectedClient = GmCliente::find($value);
        }
    }
    
    public function selectClient($clientId)
    {
        $this->selected = $clientId;
        $this->updating('selected', $clientId);
        $this->topics = GmTopico::where('clienteId', $clientId)->get();
        dump($this->topics);
        $this->showClientDashboard = true;
    }

    public function mount()
    {
        $this->clients = GmCliente::where('showWeb', true)->get();
    }

    public function render()
    {
        return view('livewire.client-dashboard');
    }
}
