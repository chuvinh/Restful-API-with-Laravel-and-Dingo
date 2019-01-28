<?php

namespace App\Console\Commands;

use App\Models\WeatherStatus;
use App\Services\QueryService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class QueryWeatherStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'query:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all the data from weather apps (custom query)';

    protected $queryService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(QueryService $queryService)
    {
        // uncomment this and every time we run query:all the database will be flushed
//        DB::statement("SET foreign_key_checks=0");
//        WeatherStatus::truncate();
//        DB::statement("SET foreign_key_checks=1");
        $this->queryService = $queryService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Query started..... ');

        try {
            $this->queryService->queryAll();
        } catch (\Exception $exception)
        {
            $this->error($exception->getMessage());
            return 1;
        }

        $this->info('Query successful');
    }
}
