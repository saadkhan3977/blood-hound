<?php
namespace App\Helpers;

use App\Models\User;
use App\Models\Notification;
use App\Models\GoalHistory;
use App\Notifications\StatusNotification;
// use Auth;
class Helper{

    public static function penalty(){
        return "helper function 1 response";
    }

    public static function goal_history($id)
    {
        $user = User::with('goal')->find($id);
        GoalHistory::create([
            'goal_name' => $user->goal->goal_name,
            'amount_save' => $user->goal->amount_save,
            'plan' => $user->goal->plan,
            'starting_date' => $user->goal->starting_date,
            'ending_date' => $user->goal->ending_date,
            'number_deduction' => $user->goal->number_deduction,
            'amount_per_deduction' => $user->goal->amount_per_deduction,
            'cnd' => 1,
            'user_id' => $id,
            'created_at' => date('Y-m-d')
        ]);
    }
    
    public static function user($email)
    {
        return User::where('email',$email)->first();
    }

    public static function goal_complete($id)
    {
        $userss = User::find($id);
        $details=[
            'title'=>'Admin',
            'description'=>'Goal Complete',
        ];
        return \Notification::send($userss, new StatusNotification($details));
    }
    
    public static function payment_charge($id)
    {
        $userss = User::find($id);
        $details=[
            'title'=>'Admin',
            'description'=>'Payment Charged',
        ];
        return \Notification::send($userss, new StatusNotification($details));
    }

    public static function onedaybefore($id)
    {
        $userss = User::find($id);
        $details=[
            'title'=>'Admin',
            'description'=>'Payment will be charged soon after 2 days.',
        ];
        return \Notification::send($userss, new StatusNotification($details));
    }

    public static function twodaybefore()
    {
        $userss = User::find($user->id);
        $details=[
            'title'=>'Admin',
            'description'=>'Payment will be charged tomorrow.',
        ];
        return \Notification::send($userss, new StatusNotification($details));
    }
    
    public static function goalpoint($id)
    {
        /* $gh = GoalHistory::where('user_id',$user->id)->count();		
        $point = $user->points + 5;
        //}
        if($gh == 3)
        {
            $point = $point + 10;
        }
        if($gh == 3)
        {
            $point = $user->points + 10;
        }
        if($gh == 5)
        {
            $point = $user->points + 15;
        } */
        $user = User::find($id);
        $gh = GoalHistory::where('user_id',$id)->count();	
        
        $point = $user->points + 10;
        
        if($gh == 5)
        {
            $point = $user->points + 20;
        }
        return $point;
    }
    
    public static function lategoalpoint($subtract,$id)
    {
        $user = User::find($id);
        $gh = GoalHistory::where('user_id',$id)->count();		
        $point = $user->points + 10;
        
        if($gh == 5)
        {
            $point = $point + 10;
        }
        return $point - $subtract;
    }
}

?>