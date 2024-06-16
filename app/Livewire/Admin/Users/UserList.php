<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Nom et prenom'],
            ['key' => 'email', 'label' => 'Email'] # <---- nested attributes
        ];

        $users = User::all();
        return view('livewire.admin.users.user-list', [
            'headers' => $headers,
            'users' => $users
        ]);
    }
}
