<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Hours;
use App\Payments;
use App\User;
use Auth;
use DB;

class easyController extends Controller
{
    public function hours(){
        //wyświetlanie z bazy danych wszystkich wyników
        //$hours = Hours::all();

        //wyświetlanie z bazy danych wszystkich wyników, posortowane
        $user = Auth::user()->name;

        $hours = Hours::orderBy('id', 'desc')->where('kto', $user)->get();
        $total = DB::table('hours')->where('kto', $user)->select(DB::raw("SEC_TO_TIME( SUM( TIME_TO_SEC(total))) as suma"))->value('suma');
        

        return view('hours.hours', [
            'hours' => $hours,
            'total' => $total
        ]);
    }
    //widok dodawania godzin
    // public function add(){
    //     return view('hours.add');
    // }
    //zapisywanie godzin do bazy danych
    
    public function save(){
        $hour = new Hours();
        
        
        $hour->start_work = request('start_work');
        $hour->stop_work = request('stop_work');
        $hour->dzien = request('dzien');
        $hour->kto = request('kto');

        //obliczanie różnicy w czasie
        $startTime = Carbon::parse($hour->start_work);
        $finishTime = Carbon::parse($hour->stop_work);
        $diff = $finishTime->diff($startTime)->format('%h:%i:%s');
        $hour->total = request('finishTime', $diff);

        //zapisywanie do bazy danych
        $hour->save(); 

        return redirect('/hours');
    }

    public function delete($id){
        $hour = Hours::findOrFail($id);
        $hour->delete();

        return redirect('/hours');
    }

    public function payment(){
        $payments = Payments::all();

        return view('payment.payment', [
            'payments' => $payments
        ]);   
    }

    public function deletePay($id){
        $payment = Payments::findOrFail($id);
        $payment->delete();

        return redirect('/payment');
    }

    public function addPay(){
        return view('payment.newpay');
    }
    //zapisywanie godzin do bazy danych
    
    public function savePay(){
        $payment = new Payments();
        
        
        $payment->kwota = request('kwota');
        $payment->data = request('data');

        //zapisywanie do bazy danych
        $payment->save(); 

        return redirect('/')->with('mssg', 'Dodano nową wypłatę!');
    }
}
