<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\EmailController;

class EmailConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:email-console';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia os e-mails para os sellers e admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controller = new EmailController();
        $execute = $controller->send();
        $this->info('Rotina executada. Resultado: ' . $execute);
    }
}
