<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GmCliente;
use App\Models\GmTopico;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Livewire\Attributes\Layout;
use Filament\Schemas\Schema;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;

class ClientDashboard extends Component implements HasSchemas
{
    use InteractsWithSchemas;
    public $clients;
    public $selected;
    public $selectedClient;
    public $topics;
    public ?array $data = [];
    public $showClientDashboard = false;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                ->columns(3)
                ->schema([
                    Select::make('selectedTime')
                        ->required()
                        ->label('Temporalidad')
                        ->default('mensual')
                        ->options([
                            'semanal' => 'Semanal',
                            'mensual' => 'Mensual',
                            'trimestral' => 'Trimestral',
                        ])
                        ->live(),
                    DatePicker::make('startDate')
                        ->label('Fecha de inicio')
                        ->live(),
                    DatePicker::make('endDate')
                        ->label('Fecha de término')
                        ->live(),
                    // ...
                        ]),
                    Grid::make()
                        ->columns(1)
                        ->schema([
                            Select::make('selectedBranch')
                                ->label('Sucursal')
                                ->options(function () {
                                    if ($this->selectedClient) {
                                        return $this->selectedClient->sucursales->pluck('sucursalNombre', 'sucursalNombre')->toArray();
                                    }
                                    return [];
                                })
                                ->live(),
                        ]),
            ])
            ->statePath('data');
    }


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
        $this->showClientDashboard = true;
    }

    public function goBack()
    {
        $this->showClientDashboard = false;
        $this->selected = null;
        $this->selectedClient = null;
        $this->topics = null;
    }

    public function mount()
    {
        $this->clients = GmCliente::where('showWeb', true)->get();
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.client-dashboard');
    }
}
