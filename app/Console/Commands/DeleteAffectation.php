<?php

namespace App\Console\Commands;

use App\Models\Affectation;
use Illuminate\Console\Command;

class DeleteAffectation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:affectations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        Affectation::whereDate('created_at', now()->subDays(2))->delete();

        return 1;
    }
}
