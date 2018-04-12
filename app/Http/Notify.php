<?php
namespace App\Notifications;

use App\Models\Ticket;
use App\Models\User;
use App\Models\TicketAssignment;
use App\Jobs\PushNotification;

class Notify
{
    private static $fcmURL = 'https://fcm.googleapis.com/fcm/send';
    private static $fcmKey = 'AIzaSyCBB1hN3Jk8ekX62fQJXsLmBcRQLyejNBk';

    public static function ticketNotification()
    {

        $user=User::all();
        foreach ($user as $us){
            if(!empty($us->account_type)){
                if($us->account_type=='App\Models\Learner'){
                    $tickets=Ticket::where('learner_id',$us->account_id)->where("is_archived",0)->where('is_completed',0)->pluck('id')->toArray();
                    $assignments=TicketAssignment::whereIn('ticket_id',$tickets)->where('target_date',date("Y-m-d"))->count();
                    if($assignments > 0){
                        $data['fcm_token']=$us->fcm_token;
                        if(!empty($fcm_token)){
                            $data['notification'] = [
                                'title' => "Ticket Notification",
                                'message' =>"You have ".$assignments." Ticket(s) scheduled for today to Manage Better!",
                            ];
                            $notification=Notify::sendPushNotification($data);
                            PushNotification::dispatch($notification);
                        }
                    }

                }
                elseif($us->account_type=='App\Models\Organization'){
                    $deps=Department::where('organization_id',$us->account_id)->pluck('id')->toArray();
                    $learners=Learner::whereIn('department_id',$deps)->pluck('id')->toArray();
                    $tickets=Ticket::with(['assignments'])->whereIn('learner_id',$learners)->where("is_archived",0)->where('is_completed',0)->pluck('id')->toArray();
                    $assignments=TicketAssignment::whereIn('ticket_id',$tickets)->where('target_date',date("Y-m-d"))->count();
                    $data['fcm_token']=$us->fcm_token;
                    if(!empty($fcm_token)){
                        $data['notification'] = [
                            'title' => "Ticket Notification",
                            'message' =>"Your organization has $assignments Ticket(s) schedulded for today to Manage Better!",
                        ];
                        $notification=Notify::sendPushNotification($data);
                        PushNotification::dispatch($notification);
                    }
                }

            }
        }
    }


    public static function sendPushNotification($data){

        $fcm_token= $data['fcm_token'];

        $notification = $data['notification'];

        $fields = array(
            'to'           => $fcm_token,
            'data' => $notification
        );
        $headers = array(
            'Authorization: key=' . self::$fcmKey,
            'Content-Type: application/json'
        );


        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt( $ch, CURLOPT_URL, self::$fcmURL );

        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Avoids problem with https certificate
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);

        // Execute post
        $result = curl_exec($ch);

        // Close connection
        curl_close($ch);

        return $result;
        // }


    }

}