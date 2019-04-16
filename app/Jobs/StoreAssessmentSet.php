<?php

namespace App\Jobs;

use App\Models\AssessmentSet;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class StoreAssessmentSet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $learnings = $this->data['learnings'];
        $assessor_id = $this->data['assessor_id'];
        $organization_id = $this->data['organization_id'];

        if(count($learnings) > 0){

            $set['assessor_id'] = $assessor_id;
            $set['organization_id'] = $organization_id;
            $assessmentSet = AssessmentSet::create($set);
            $setId =$assessmentSet->id;

            foreach ($learnings as $module => $statements){
                $data['module'] = $module;
                if(count($statements) > 0){
                    foreach ($statements as $statement){
                        $data['statement'] = $statement;
                        $data['assessment_id'] = $setId;
                    }
                }
            }
        }
    }
}
