<?php

namespace App\Livewire\Forms\Shipping;

use App\Models\Address;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditAddressForm extends Form
{
    public $id;
    public $type = '';
    public $description = '';
    public $zone = '';
    public $reference = '';
    public $receiver = 1;
    public $receiver_info = [];
    public $default = false;

    public function rules() {

        return [
            
            'type' => 'required|in:1,2',
            'description' => 'required|string',
            'zone' => 'required|string',
            'reference' => 'required|string',
            'receiver' => 'required|in:1,2',
            'receiver_info' => 'required|array',
            'receiver_info.name' => 'required|string',
            'receiver_info.last_name' => 'required|string',
            'receiver_info.document_number' => 'required|string',
            'receiver_info.phone' => 'required|string',
        ];
    }

    public function validationAttributes() {

        return [
            'type' => 'tipo',
            'description' => 'dirección',
            'zone' => 'zona',
            'reference' => 'referencia',
            'receiver' => 'receptor',
            'receiver_info.name' => 'nombre',
            'receiver_info.last_name' => 'apellidos',
            'receiver_info.document_number' => 'número de dni',
            'receiver_info.phone' => 'teléfono',
        ];
    }

    public function edit($address) {

        $this->id = $address->id;
        $this->type = $address->type;
        $this->description = $address->description;
        $this->zone = $address->zone;
        $this->reference = $address->reference;
        $this->receiver = $address->receiver;
        $this->receiver_info = $address->receiver_info;
        $this->default = $address->default;
    }

    public function update() {
        $this->validate();
        $address = Address::find($this->id);
        $address->update([
            'type' => $this->type,
            'description' => $this->description,
            'zone' => $this->zone,
            'reference' => $this->reference,
            'receiver' => $this->receiver,
            'receiver_info' => $this->receiver_info,
            'default' => $this->default,
        ]);

        $this->reset();
    }
}
