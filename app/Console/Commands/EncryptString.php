<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;

class encryptString extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'encrypt {string}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encrypt a string using the Encryption helper';

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
     * @return
     */
    public function handle()
    {
        $string = $this->argument('string');
        
        echo PHP_EOL;
        $this->line("Your encrypted string: " . PHP_EOL . PHP_EOL );
        $this->comment( Crypt::encryptString( $string )  );
        echo PHP_EOL . PHP_EOL;
        
        return 0;
    }
}
