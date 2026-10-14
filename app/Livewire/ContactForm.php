<?php

namespace App\Livewire;

use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $message = '';
    public string $captchaToken = '';

    public bool $sent = false;

    public function send(): void
    {
        $this->sent = false;

        $data = $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'subject' => ['required', 'string', 'min:3', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'captchaToken' => ['required', 'string'],
        ], [
            'name.required' => 'El nombre es requerido.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre debe tener menos de 100 caracteres.',
            'email.required' => 'El correo es requerido.',
            'email.email' => 'El correo debe ser válido.',
            'email.max' => 'El correo debe tener menos de 150 caracteres.',
            'subject.required' => 'El asunto es requerido.',
            'subject.min' => 'El asunto debe tener al menos 3 caracteres.',
            'subject.max' => 'El asunto debe tener menos de 150 caracteres.',
            'message.required' => 'El mensaje es requerido.',
            'message.min' => 'El mensaje debe tener al menos 10 caracteres.',
            'message.max' => 'El mensaje debe tener menos de 5000 caracteres.',
            'captchaToken.required' => 'Completa la verificación de seguridad.',
        ]);

        $key = 'contact:' . sha1(request()->ip() ?? 'unknown');

        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages([
                'message' => 'Has realizado demasiados intentos. Intenta más tarde.',
            ]);
        }

        RateLimiter::hit($key, 3600);

        try {
            $response = Http::asForm()
                ->timeout(10)
                ->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => config('services.recaptcha.secret_key'),
                    'response' => $this->captchaToken,
                    'remoteip' => request()->ip(),
                ]);

            if (
                !$response->successful() ||
                $response->json('success') !== true
            ) {
                throw ValidationException::withMessages([
                    'captchaToken' => 'No se pudo verificar el reCAPTCHA.',
                ]);
            }

            Mail::to(config('mail.contact_to'))
                ->send(new ContactMessage(
                    $data['name'],
                    $data['email'],
                    $data['subject'],
                    $data['message']
                ));

        } catch (ValidationException $e) {
            $this->reset('captchaToken');
            $this->dispatch('contact-captcha-reset');
            throw $e;

        } catch (\Throwable $e) {
            report($e);

            $this->reset('captchaToken');
            $this->dispatch('contact-captcha-reset');

            $this->addError(
                'form',
                'No fue posible enviar el mensaje. Intenta nuevamente.'
            );

            return;
        }

        $this->reset([
            'name',
            'email',
            'subject',
            'message',
            'captchaToken',
        ]);

        $this->resetValidation();

        $this->sent = true;

        $this->dispatch('contact-captcha-reset');
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
