<div>
    @if ($sent)
        <div class="alert alert-success" role="status">
            Tu mensaje fue enviado correctamente.
            Nos comunicaremos contigo pronto.
        </div>
    @endif

    @error('form')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror

    <form wire:submit="send" novalidate>
        <div class="row g-3">

            <div class="col-md-6">
                <label for="contact-name" class="form-label">
                    Nombre completo
                </label>
                <input type="text" id="contact-name" wire:model="name"
                    class="form-control @error('name') is-invalid @enderror" autocomplete="name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="contact-email" class="form-label">
                    Correo electrónico
                </label>
                <input type="email" id="contact-email" wire:model="email"
                    class="form-control @error('email') is-invalid @enderror" autocomplete="email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="contact-subject" class="form-label">
                    Asunto
                </label>
                <input type="text" id="contact-subject" wire:model="subject"
                    class="form-control @error('subject') is-invalid @enderror">
                @error('subject')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="contact-message" class="form-label">
                    Mensaje
                </label>
                <textarea id="contact-message" wire:model="message" rows="6"
                    class="form-control @error('message') is-invalid @enderror"></textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <div wire:ignore>
                    <div id="valensa-recaptcha"></div>
                </div>

                @error('captchaToken')
                    <div class="text-danger small mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary px-5 py-3" wire:loading.attr="disabled" wire:target="send">
                    <span wire:loading.remove wire:target="send">
                        Enviar mensaje
                    </span>

                    <span wire:loading wire:target="send">
                        <span class="spinner-border spinner-border-sm me-2"></span>
                        Enviando...
                    </span>
                </button>
            </div>

        </div>
    </form>
</div>

@script
<script>
    let captchaWidget = null;

    window.valensaCaptchaReady = () => {
        captchaWidget = grecaptcha.render('valensa-recaptcha', {
            sitekey: @js(config('services.recaptcha.site_key')),
            callback: token => $wire.set('captchaToken', token),
            'expired-callback': () => $wire.set('captchaToken', ''),
            'error-callback': () => $wire.set('captchaToken', '')
        });
    };

    $wire.on('contact-captcha-reset', () => {
        if (captchaWidget !== null && window.grecaptcha) {
            grecaptcha.reset(captchaWidget);
        }
    });

    if (window.grecaptcha?.render) {
        window.valensaCaptchaReady();
    } else {
        const script = document.createElement('script');
        script.src = 'https://www.google.com/recaptcha/api.js?onload=valensaCaptchaReady&render=explicit';
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    }
</script>
@endscript