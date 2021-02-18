<?php

namespace Application\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RecreateDatabaseWithSeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'specto:dbdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'With this command we wipe data, run migrations and seeds with dummy data.';

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
        $bar = $this->output->createProgressBar(3);
        Artisan::call('db:wipe --force');
        $bar->advance();
        Artisan::call('migrate --force');
        $bar->advance();
        Artisan::call('db:seed --force');
        $bar->finish();

        $this->info(PHP_EOL.'You created clean testing database.');
    }
}
