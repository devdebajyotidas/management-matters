<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateAttachments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate all images';

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
        $tables = ['learners', 'organizations', 'learnings'];

        foreach ($tables as $table){
            $rows = DB::table($table)->whereNotNull('image')->get();
            $this->comment('total '.$rows->count().' found in '. $table. ' table');
            if(count($rows) > 0){
                foreach ($rows as $row){
                    $path = public_path('attachments').'/'.$row->image;
                    $this->comment('path: '.$path);

                    $exists = file_exists($path);
                    $this->comment('file exists '.$exists );
                }
            }
        }
    }
}