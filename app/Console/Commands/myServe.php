<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MyServe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'myServe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calls ./artisan serve with paramaters from the .env file.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo "Host: " . env("HTTP_HOST_DEV") . PHP_EOL;
        echo "Port: " . env("HTTP_PORT_DEV") . PHP_EOL;

        $this->call('serve', [
            '--host' => env("HTTP_HOST_DEV"), '--port' => env("HTTP_PORT_DEV")
        ]);
    }
}
