<?php

namespace App\Console\Commands;

use App\Services\DidomService;
use Illuminate\Console\Command;

class didom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'didom:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(DidomService $didomService)
    {
        $didomService->parse();
    }
}
