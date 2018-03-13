<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Quotes;

class QuotesSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quotes:schedule';

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
     * @return mixed
     */
    public function handle()
    {
        DB::beginTransaction();
        $allquotes=Quotes::all();
        if(count($allquotes) > 0){
            $randomized = $allquotes->shuffle();
            $quotes=$randomized->filter(function ($item) {
                return $item->is_active != 1;
            })->values()->first();
            $active=$randomized->filter(function ($item) {
                return $item->is_active == 1;
            })->values()->first();

            if($active){
                $active->update(['is_active'=>0]);
            }

            if($quotes){
                $update=Quotes::find($quotes->id);
                $update->update(['is_active'=>1]);
                DB::commit();
            }
            else{
                DB::rollback();
            }
        }
    }
}
