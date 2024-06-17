<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;
    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Nom et prenom'],
            ['key' => 'email', 'label' => 'Email'] # <---- nested attributes
        ];

        $users = User::paginate(24);
        return view('livewire.admin.users.user-list', [
            'headers' => $headers,
            'users' => $users
        ]);
    }
}
