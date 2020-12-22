@component('mail::message')
# Olá!

Clique no botão abaixo para verificar seu endereço de e-mail

@component('mail::button', ['url' => $url])
Verificar E-mail
@endcomponent

Se você não criou a conta, favor desconsiderar este e-mail

Atenciosamente,<br>
{{ config('app.name') }}

@component('mail::subcopy')
Se você estiver com problemas para clicar no botão "Verificar E-mail", copie e cole o URL abaixo em seu navegador da web: <a href="{{ $url }}">{{ $url }}</a>    
@endcomponent

@endcomponent
