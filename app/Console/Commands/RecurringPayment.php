<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Goal;
use App\Models\GoalHistory;
use App\Models\Payment;
use App\Models\TemporaryWallet;
use App\Models\Wallet;
use App\Models\Tranasaction;
use Carbon\Carbon;
use Helper;

class RecurringPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurring:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		try 
        {
            // $stripe = \Stripe\Stripe::setApiKey('sk_test_51LCrVHHNvw3AIrpxjbOuGKoRaQ3K68ZDXrgU41PRmyDb9eH7h9qShHEn1T8gEUV7amg1TfNSy1cVXWaREFgcfmMr00yqKik6dg');
            $stripe = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $users = User::with('goal')->get();
            foreach($users as $user)
            {
                
                if($user->goal)
                {
                    $payment = Payment::where('customer_id',$user->stripe_id)->orderBy('id','desc')->first();                
                    // return $payment;
                    // return $payment->created_at;
                    $days = Carbon::parse($payment->created_at)->diffInDays(Carbon::now());
                    $temporarywallet = TemporaryWallet::where('user_id',$user->id)->first();
                    $wallet = Wallet::where('user_id',$user->id)->first();
                    
                    if($user->goal->cnd < $user->goal->number_deduction)
                    { 
                        if($user->goal->plan == 'Weekly')
                        {
                            // return $days;
                            if($days == '6')
                            {
                                Helper::twodaybefore($user->id);
                            }
                            if($days == '7')
                            {
                                Helper::onedaybefore($user->id);
                            }
                            if( $days == '8')
                            {
                                $perdeduction = $user->goal->amount_per_deduction;
                                $charge = \Stripe\Charge::create([
                                    'amount' => round($perdeduction),
                                    'currency' => 'usd',
                                    'customer' => $user->stripe_id,
                                ]);

                                Payment::create([
                                    'amount' => round($perdeduction),
                                    'customer_id' => $user->stripe_id,
                                    'currency' => 'usd',
                                ]);
                                $user->goal->update([
                                    'cnd' => $user->goal->cnd + 1
                                ]);

                                $temporarywallet->update([
                                    'amount' => $temporarywallet->amount + $perdeduction,
                                ]);

                                
                                Helper::payment_charge($user->id);
                                
                                if($user->goal->cnd == $user->goal->number_deduction)
                                {
                                    Helper::goal_complete($user->id);
                                    
                                    Payment::where('customer_id',$user->stripe_id)->delete();
                                    /* Tranasaction::create([
                                        'user_id' => $user->id,
                                        'amount' => $wallet->amout + $temporarywallet->amount,
                                        'date' => date('M-d-Y'),
                                        'reason' => 'Goal Complete',
                                        'type' => 'Credit',
                                        'status' => 'Credit',
                                    ]); */
                                    Helper::goal_history($user->id);
                                    $user->goal->delete();
                                    
                                    $point = Helper::goalpoint($user->id);
                                    
                                    Tranasaction::create([
                                        'user_id' => $user->id,
                                        'amount' => $wallet->amout + $temporarywallet->amount,
                                        'date' => date('M-d-Y'),
                                        'reason' => 'Goal Complete',
                                        'type' => 'Credit',
                                        'status' => 'Credit',
                                    ]);
									
                                    
                                    
									
									
                                    $wallet->update([
                                        'amount' => $wallet->amout + $temporarywallet->amount,
                                    ]);

                                    $user->update([
                                        'is_goal' => 0,
                                        'points' => $point
                                    ]);

                                    $temporarywallet->update([
                                        'amount' => 0,
                                    ]);
                                }
                            }

                            if($days == '13')
                            {
                                Helper::twodaybefore($user->id);
                            }
                            if($days == '14')
                            {
                                Helper::onedaybefore($user->id);
                            }
                            if($days == '15')
                            {

                                // $penalty =  $user->goal->amount_save ;
                                // $chargeamount = $user->goal->amount_per_deduction + $penalty;
                                $chargeamount = $user->goal->amount_per_deduction * 2;
                                
                                $charge = \Stripe\Charge::create([
                                    'amount' => round($chargeamount),
                                    'currency' => 'usd',
                                    'customer' => $user->stripe_id,
                                ]);
                                $payment = $user->goal->amount_per_deduction;
                                Payment::create([
                                    'amount' => $payment ,
                                    'status' => 'Late Payment',
                                    'customer_id' => $user->stripe_id,
                                    'currency' => 'usd',
                                ]);
                                
                                Payment::create([
                                    'amount' => $payment ,
                                    'status' => 'Late Payment',
                                    'customer_id' => $user->stripe_id,
                                    'currency' => 'usd',
                                ]);
                                $user->goal->update([
                                    'cnd' => $user->goal->cnd + 2
                                ]);
                                $walletamount = $user->goal->amount_per_deduction * 2;
                                $temporarywallet->update([
                                    'amount' => $temporarywallet->amount + $walletamount,
                                ]);

                                
                                Helper::payment_charge($user->id);
                                

                                if($user->goal->cnd == $user->goal->number_deduction)
                                {
                                    Helper::goal_complete($user->id);
                                    
                                    Payment::where('customer_id',$user->stripe_id)->delete();
                                    Helper::goal_history($user->id);
                                    Tranasaction::create([
                                        'user_id' => $user->id,
                                        'amount' => $wallet->amout + $temporarywallet->amount,
                                        'date' => date('M-d-Y'),
                                        'reason' => 'Goal Complete',
                                        'type' => 'Credit',
                                        'status' => 'Credit',
                                    ]);

                                    
									
									$user->goal->delete();
                                    $wallet->update([
                                        'amount' => $wallet->amout + $temporarywallet->amount,
                                    ]);
                                    $point = Helper::lategoalpoint(2,$user->id);
                                
                                    $user->update([
                                        'is_goal' => 0,
										'points' => $point
                                    ]);

                                    $temporarywallet->update([
                                        'amount' => 0,
                                    ]);
                                }
                            }
                            
                            if($days == '20')
                            {
                                Helper::twodaybefore($user->id);
                            }
                            if($days == '21')
                            {
                                Helper::onedaybefore($user->id);
                            }
                            if($days == '22')
                            {

                                $chargeamount = $user->goal->amount_per_deduction * 3;
                                
                                $charge = \Stripe\Charge::create([
                                    'amount' => $chargeamount*100,
                                    'currency' => 'usd',
                                    'customer' => $user->stripe_id,
                                ]);
                                $payment = $payment->amount + $user->goal->amount_per_deduction;
                                Payment::create([
                                    'amount' => $payment ,
                                    'penalty' => 'Late Payment',
                                    'customer_id' => $user->stripe_id,
                                    'currency' => 'usd',
                                ]);
                                
                                Payment::create([
                                    'amount' => $payment + $user->goal->amount_per_deduction,
                                    'penalty' => 'Late Payment',
                                    'customer_id' => $user->stripe_id,
                                    'currency' => 'usd',
                                ]);
                                Payment::create([
                                    'amount' => $payment + $user->goal->amount_per_deduction,
                                    'penalty' => 'Late Payment',
                                    'customer_id' => $user->stripe_id,
                                    'currency' => 'usd',
                                ]);
                                $user->goal->update([
                                    'cnd' => $user->goal->cnd + 3
                                ]);

                                $temporarywallet->update([
                                    'amount' => $temporarywallet->amount + $user->goal->amount_per_deduction,
                                ]);
                                
                                Helper::payment_charge($user->id);

                                if($user->goal->cnd == $user->goal->number_deduction)
                                {
                                    Helper::goal_complete($user->id);
                                    
                                    Payment::where('customer_id',$user->stripe_id)->delete();
                                    Helper::goal_history($user->id);
                                    Tranasaction::create([
                                        'user_id' => $user->id,
                                        'amount' => $wallet->amout + $temporarywallet->amount,
                                        'date' => date('M-d-Y'),
                                        'reason' => 'Goal Complete',
                                        'type' => 'Credit',
                                        'status' => 'Credit',
                                    ]);
                                   
                                    $point = Helper::lategoalpoint(4,$user->id);
									
									$user->goal->delete();
                                    $wallet->update([
                                        'amount' => $wallet->amout + $temporarywallet->amount,
                                    ]);

                                    $user->update([
                                        'is_goal' => 0,
										'points' => $point
                                    ]);

                                    $temporarywallet->update([
                                        'amount' => 0,
                                    ]);
                                }
                            }

                            if($days == '27')
                            {
                                Helper::twodaybefore($user->id);
                            }
                            if($days == '28')
                            {
                                Helper::onedaybefore($user->id);
                            }
                            if($days == '29')
                            {

                                $chargeamount = $user->goal->amount_per_deduction * 4;
                                
                                $charge = \Stripe\Charge::create([
                                    'amount' => $chargeamount*100,
                                    'currency' => 'usd',
                                    'customer' => $user->stripe_id,
                                ]);
                                $payment = $payment->amount + $user->goal->amount_per_deduction;
                                Payment::create([
                                    'amount' => $payment ,
                                    'penalty' => 'Late Payment',
                                    'customer_id' => $user->stripe_id,
                                    'currency' => 'usd',
                                ]);
                                
                                Payment::create([
                                    'amount' => $payment + $user->goal->amount_per_deduction,
                                    'penalty' => 'Late Payment',
                                    'customer_id' => $user->stripe_id,
                                    'currency' => 'usd',
                                ]);
                                Payment::create([
                                    'amount' => $payment + $user->goal->amount_per_deduction,
                                    'penalty' => 'Late Payment',
                                    'customer_id' => $user->stripe_id,
                                    'currency' => 'usd',
                                ]);
                                Payment::create([
                                    'amount' => $payment + $user->goal->amount_per_deduction,
                                    'penalty' => 'Late Payment',
                                    'customer_id' => $user->stripe_id,
                                    'currency' => 'usd',
                                ]);
                                $user->goal->update([
                                    'cnd' => $user->goal->cnd + 1
                                ]);

                                $temporarywallet->update([
                                    'amount' => $temporarywallet->amount + $user->goal->amount_per_deduction,
                                ]);
                                
                                // Notification payment
                                Helper::payment_charge($user->id);

                                if($user->goal->cnd == $user->goal->number_deduction)
                                {
                                    Helper::goal_complete($user->id);
                                    Payment::where('customer_id',$user->stripe_id)->delete();
                                    Helper::goal_history($user->id);
                                    Tranasaction::create([
                                        'user_id' => $user->id,
                                        'amount' => $wallet->amout + $temporarywallet->amount,
                                        'date' => date('M-d-Y'),
                                        'reason' => 'Goal Complete',
                                        'type' => 'Credit',
                                        'status' => 'Credit',
                                    ]);
                                    $point = Helper::lategoalpoint(6,$user->id);
									
									$user->goal->delete();
                                    $wallet->update([
                                        'amount' => $wallet->amout + $temporarywallet->amount,
                                    ]);

                                    $user->update([
                                        'is_goal' => 0,
										'points' => $point
                                    ]);

                                    $temporarywallet->update([
                                        'amount' => 0,
                                    ]);
                                }
                            } 
                        }
                    
                        if($user->goal->plan == 'bi-weekly')
                        {
                            // return $user->stripe_id;
                            if($days == '12')
                            {
                                Helper::twodaybefore($user->id);
                            }
                            if($days == '13')
                            {
                                Helper::onedaybefore($user->id);
                            }
                            if($days == '15')
                            {
                                $charge = \Stripe\Charge::create([
                                    'amount' => $user->goal->amount_per_deduction*100,
                                    'currency' => 'usd',
                                    'customer' => $user->stripe_id,
                                ]);

                                Payment::create([
                                    'amount' => $user->goal->amount_per_deduction,
                                    'customer_id' => $user->stripe_id,
                                    'currency' => 'usd',
                                ]);
                                $user->goal->update([
                                    'cnd' => $user->goal->cnd + 1
                                ]);
                                $temporarywallet->update([
                                    'amount' => $temporarywallet->amount + $user->goal->amount_per_deduction,
                                ]);
                                
                                Helper::payment_charge($user->id);
                                if($user->goal->cnd == $user->goal->number_deduction)
                                {
                                    Helper::goal_complete($user->id);                                  
                                    Payment::where('customer_id',$user->stripe_id)->delete();
                                    Helper::goal_history($user->id);
                                    
                                    Tranasaction::create([
                                        'user_id' => $user->id,
                                        'amount' => $wallet->amout + $temporarywallet->amount,
                                        'date' => date('M-d-Y'),
                                        'reason' => 'Goal Complete',
                                        'type' => 'Credit',
                                        'status' => 'Credit',
                                    ]);
                                    
                                    $point = Helper::goalpoint();
									
									$user->goal->delete();
                                    $wallet->update([
                                        'amount' => $wallet->amout + $temporarywallet->amount,
                                    ]);

                                    $user->update([
                                        'is_goal' => 0,
										'points' => $point
                                    ]);

                                    $temporarywallet->update([
                                        'amount' => 0,
                                    ]);
                                }
                            }
                            
                            if($days == '28')
                            {
                                Helper::twodaybefore($user->id);
                            }
                            if($days == '29')
                            {
                                Helper::onedaybefore($user->id);
                            }
                            if($days == '30')
                            {
                                $charge = \Stripe\Charge::create([
                                    'amount' => $user->goal->amount_per_deduction*100,
                                    'currency' => 'usd',
                                    'customer' => $user->stripe_id,
                                ]);

                                Payment::create([
                                    'amount' => $user->goal->amount_per_deduction,
                                    'customer_id' => $user->stripe_id,
                                    'currency' => 'usd',
                                ]);
                                $user->goal->update([
                                    'cnd' => $user->goal->cnd + 1
                                ]);
                                $temporarywallet->update([
                                    'amount' => $temporarywallet->amount + $user->goal->amount_per_deduction,
                                ]);
                                
                                Helper::payment_charge($user->id);
                                if($user->goal->cnd == $user->goal->number_deduction)
                                {
                                    Helper::goal_complete($user->id);                                  
                                    Payment::where('customer_id',$user->stripe_id)->delete();
                                    Helper::goal_history($user->id);
                                    
                                    Tranasaction::create([
                                        'user_id' => $user->id,
                                        'amount' => $wallet->amout + $temporarywallet->amount,
                                        'date' => date('M-d-Y'),
                                        'reason' => 'Goal Complete',
                                        'type' => 'Credit',
                                        'status' => 'Credit',
                                    ]);
                                    
                                    $point = Helper::lategoalpoint();
									
									$user->goal->delete();
                                    $wallet->update([
                                        'amount' => $wallet->amout + $temporarywallet->amount,
                                    ]);

                                    $user->update([
                                        'is_goal' => 0,
										'points' => $point
                                    ]);

                                    $temporarywallet->update([
                                        'amount' => 0,
                                    ]);
                                }
                            }
                        }
                        
                        if($user->goal->plan == 'Monthly')
                        {
                            if($days == '29')
                            {
                                Helper::twodaybefore($user->id);
                            }
                            if($days == '30')
                            {
                                Helper::onedaybefore($user->id);
                            }
                            if($monthdays > '30')
                            {
                                $charge = \Stripe\Charge::create([
                                    'amount' => $user->goal->amount_per_deduction*100,
                                    'currency' => 'usd',
                                    'customer' => $user->stripe_id,
                                ]);

                                Payment::create([
                                    'amount' => $user->goal->amount_per_deduction,
                                    'customer_id' => $user->stripe_id,
                                    'currency' => 'usd',
                                ]);
                                $user->goal->update([
                                    'cnd' => $user->goal->cnd + 1
                                ]);
                                $temporarywallet->update([
                                    'amount' => $temporarywallet->amount + $user->goal->amount_per_deduction,
                                ]);

                                Helper::payment_charge($user->id);
                                if($user->goal->cnd == $user->goal->number_deduction)
                                {
                                    Helper::goal_complete($user->id);                                    
                                    Payment::where('user_id',$user->id)->delete();
                                    Helper::goal_history($user->id);
                                    
                                    Tranasaction::create([
                                        'user_id' => $user->id,
                                        'amount' => $wallet->amout + $temporarywallet->amount,
                                        'date' => date('M-d-Y'),
                                        'reason' => 'Goal Complete',
                                        'type' => 'Credit',
                                        'status' => 'Credit',
                                    ]);
                                    $point = Helper::goalpoint();
									
									$user->goal->delete();
                                    $wallet->update([
                                        'amount' => $wallet->amout + $temporarywallet->amount,
                                    ]);

                                    $user->update([
                                        'is_goal' => 0,
										'points' => $point
                                    ]);

                                    $temporarywallet->update([
                                        'amount' => 0,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }
        catch(\Stripe\Exception\CardException $e) 
		{
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
}
// amount \
// date
// reason
// type {'dabit/cradit'}
// status
// user id
