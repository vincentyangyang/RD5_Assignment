<?php

namespace App\Http\Controllers;
use App\Customer;
use App\Detail;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class testController extends Controller
{

    public function login(Request $request){
        if($request->input('logout')){
            $request->session()->forget('bank_login');
            $request->session()->forget('bank_id');
            return redirect()->route('login');
        }

        if(session('bank_login')){
            return redirect()->route('index');
        }

        return view('login');
        
    }
    
    public function loginPost(Request $request){

        $admin = $request->input('admin');
        $customer = Customer::where('admin',$admin)->first();

        if($customer){
            $re = password_verify($request->input('pass'),$customer['password']);

            if($re){
                session(["bank_login"=>$admin, "bank_id"=>$customer['cId']]);
                return 'success';
            }else{
                return 'fail';
            }
        }else{
            return 'fail';
        }


    }

    public function register(){
        return view('register');
    }

    public function registerPost(Request $request){

        $admin = $request->input('admin');

        $customer = Customer::where('admin',$admin)->first();

        if($customer){
            return "exist";
        }else{
            $pass = password_hash($request->input('pass'),PASSWORD_DEFAULT);

            $att['admin'] = $request->input('admin');
            $att['password'] = $pass;
            $att['email'] = $request->input('email');
            $att['birthday'] = $request->input('birthday');
            $att['phone'] = $request->input('phone');

            // $c = new Customer;

            // $c->admin = $request->input('admin');
            // $c->password = $pass;
            // $c->email = $request->input('email');
            // $c->birthday = $request->input('birthday');
            // $c->phone = $request->input('phone');
            // $c->save();
            
            
            // Customer::create($att);
            DB::insert('insert into customers (admin,password,email,birthday,phone) values (?,?,?,?,?)', 
                [$att['admin'],$att['password'],$att['email'],$att['birthday'],$att['phone']]);
        }

        
    }
    
    public function index(){

        if (session()->has('bank_login')){
            $customer = Customer::where('cId',session('bank_id'))->first();
            $data = ['customer'=>$customer];
            return view('index',$data);
        }else{
            return redirect()->route('login');
        }
        
    }

    public function indexPost(Request $request){
        DB::update('update customers set display = ? where cId = ?', 
            [$request->input('display'), session('bank_id')]);
    }

    public function detail(){
        if (session()->has('bank_login')){
            $customer = Detail::where('cId',session('bank_id'))->orderBy('date','DESC')->get();
            $data = [
                'customer' => $customer
            ];

            return view('detail',$data);
        }else{
            return redirect()->route('login');
        }
        
    }

    public function action(Request $reqeust){
        if (session()->has('bank_login')){
            $customer = Customer::where('cId',session('bank_id'))->first();

            $data = [
                'customer' => $customer,
                'action' => $reqeust->input('action')
            ];

            return view('action',$data);
        }else{
            return redirect()->route('login');
        }

    }

    public function actionPost(Request $request){
        $customer = Customer::where('cId',session('bank_id'))->first();

        $action = $request->input('OK');

        if($action == 'deposit'){
            $cash = $request->input('money');
            $nowBalance = $customer['balance'] + $cash;
            $remarks = $request->input('remarks');

            DB::insert('insert into detail (cId,action,cash,nowBalance,remarks) values (?,?,?,?,?)', 
                [session('bank_id'), $action, $cash, $nowBalance, $remarks]);

            DB::update('update customers set balance = ? where cId = ?', 
                [$nowBalance, session('bank_id')]);
        }else{
            $cash = $request->input('money');
            $nowBalance = $customer['balance'] - $cash;
            $remarks = $request->input('remarks');

            DB::insert('insert into detail (cId,action,cash,nowBalance,remarks) values (?,?,?,?,?)', 
                [session('bank_id'), $action, $cash, $nowBalance, $remarks]);

            DB::update('update customers set balance = ? where cId = ?', 
                [$nowBalance, session('bank_id')]);      
        }

        return redirect()->route('detail');

    }
}
