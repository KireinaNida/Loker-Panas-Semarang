<?php

namespace App\Mail;

use App\Models\Lamaran;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ForwardLamaranMail extends Mailable
{
    use Queueable, SerializesModels;

    public Lamaran $lamaran;

    /**
     * Create a new message instance.
     */
    public function __construct(Lamaran $lamaran)
    {
        $this->lamaran = $lamaran->load(['user', 'lowongan', 'dokumen']);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Lamaran Kerja: ' . $this->lamaran->lowongan->nama_posisi . ' - ' . $this->lamaran->user->name . ' (via Info Loker Panas)',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.lamaran-forward',
            with: [
                'lamaran' => $this->lamaran,
                'user' => $this->lamaran->user,
                'lowongan' => $this->lamaran->lowongan,
                'dokumens' => $this->lamaran->dokumen,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        foreach ($this->lamaran->dokumen as $dok) {
            if (Storage::disk('public')->exists($dok->file_path)) {
                $attachments[] = Attachment::fromStorageDisk('public', $dok->file_path)
                    ->as($dok->nama_file_asli)
                    ->withMime($dok->mime_type ?: 'application/octet-stream');
            }
        }

        return $attachments;
    }
}
