<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class RegisterForm extends Component
{
    #[Validate(['required', 'max:150'])]
    public string $name = '';

    #[Validate(['required', 'email', 'max:150'])]
    public string $email = '';

    #[Validate(['required', 'min:6', 'confirmed'])]
    public string $password = '';

    public $password_confirmation;

    use Toast;
    public function render()
    {
        return view('livewire.admin.register-form');
    }

    public function save()
    {
       $this->validate();

       User::create([
        'name' => $this->name,
        'email' => $this->email,
        'password' => Hash::make($this->password)
       ]);

       $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        Auth::attempt($credentials);

        session()->flash('message', 'You have successfully registered & logged in!');

        $this->redirect(
            url: route('pages:home'),
        );

    }
}
