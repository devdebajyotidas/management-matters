<?php

namespace App\Jobs;

use App\Models\AssessmentSet;
use App\Models\AssessmentStatement;
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
            $set['reference'] = md5(time());
            $assessmentSet = AssessmentSet::create($set);
            $setId =$assessmentSet->id;

            Log::info($learnings);
            foreach ($learnings as  $learning){
                $data['module'] = $learning['name'];
                Log::info($data['module']);
                if(count($learning['assessments']) > 0){
                    foreach ($learning['assessments'] as $statement){
                        $data['statement'] = str_replace('am', '', str_replace('I', 'My Manager', $statement));
                        $data['assessment_id'] = $setId;
                        $data['type']=1;
                        AssessmentStatement::create($data);
                    }
                }
            }
        }
    }
}
