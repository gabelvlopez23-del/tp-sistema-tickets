<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // <-- Importante el contrato
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeUserMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $nombreUsuario;

    // El constructor recibe el nombre del usuario recién registrado
    public function __construct($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
    }

    // Configura el asunto que verá el usuario en su bandeja de entrada
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '¡Bienvenido al Sistema de Tickets de Soporte!',
        );
    }

    // Vincula el objeto de correo con la plantilla visual de Blade
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
