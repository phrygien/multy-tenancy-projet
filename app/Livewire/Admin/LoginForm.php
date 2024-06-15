<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

use function route;

final class LoginForm extends Component
{
    #[Validate(['required','email','max:255'])]
    public string $email = '';

    #[Validate(['required','string','max:255'])]
    public string $password = '';

    use Toast;

    public function submit(AuthManager $auth): void
    {
        $this->validate();

        if ( ! $auth->attempt(['email' => $this->email, 'password' => $this->password])) {
            throw ValidationException::withMessages([
                'email' => 'Failed to authenticate you.',
            ]);
        }

        $this->success(
            'You are now connected',
            'welcomme back',
            redirectTo: '/'
        );

        // $this->redirect(
        //     url: route('pages:home'),
        // );
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.admin.login-form',
        );
    }
}
