<?php
namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login'    => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $loginInput = $this->input('login');

        // Detectar si es email o nickname
        $loginType = filter_var($loginInput, FILTER_VALIDATE_EMAIL)
        ? 'email'
        : 'nickname';

        // Primero intentar en exam_users
        if (Auth::guard('exam')->attempt(
            [$loginType => $loginInput, 'password' => $this->input('password')],
            $this->boolean('remember')
        )) {
            RateLimiter::clear($this->throttleKey());
            return;
        }

        // Luego intentar en users
        if (Auth::guard('web')->attempt(
            [$loginType => $loginInput, 'password' => $this->input('password')],
            $this->boolean('remember')
        )) {
            RateLimiter::clear($this->throttleKey());
            return;
        }

        // Si fallan ambos
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'login' => trans('auth.failed'),
        ]);
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'login' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('login')) . '|' . $this->ip());
    }
}
