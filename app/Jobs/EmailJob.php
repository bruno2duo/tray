<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email_to;
    protected $subject;
    protected $content;

    /**
     * Create a new job instance.
     */
    public function __construct(string $email_to, string $subject, string $content)
    {
        $this->email_to = $email_to;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::raw($this->content, function ($message) {
            $message->from('tray@tray.com', 'Desafio Tray')
                    ->to($this->email_to)
                    ->subject($this->subject);
        });
    }
}
