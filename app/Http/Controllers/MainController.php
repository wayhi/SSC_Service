<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Mail;
use App\SSC, App\Ssc_log,App\User,App\Ssc_ball_log,App\Group;
include_once('simple_html_dom.php'); 

class MainController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
   
    public function load_ssc()
    {

        $url=['CQ'=>'/member/final/LT_result.php?gtype=CQ',
              'TJ'=>'/member/final/LT_result.php?gtype=TJ',
              'JX'=>'/member/final/LT_result.php?gtype=JX',
        ];
        $hosts_pool = ['http://www.hg7277.com',
        'http://www.hg5789.com',
        'http://www.hg7377.com',
        'http://www.hg0789.com',
        'http://www.hg2789.com',
        'http://www.hg3789.com',
        'http://www.hg3868.com',
        'http://www.cr007.com',
        'http://www.cr003.com',
        'http://www.hg29.com',
        ];
        //$host = $hosts_pool[rand(0,9)];

            Self::load_html_db($hosts_pool[rand(0,9)].$url['CQ']);
            Self::load_html_db($hosts_pool[rand(0,9)].$url['TJ']);
            Self::load_html_db($hosts_pool[rand(0,9)].$url['JX']);

            ///update log
            //Self::cal_state('重庆时时彩');
            //Self::cal_state('天津时时彩');
            //Self::cal_state('江西时时彩');
           

    }
    public function cal_state($type='重庆时时彩')
    {

        
        $ssc_log = new Ssc_log;
        $ssc_log->type = $type;
        $ssc_ball_log = new Ssc_ball_log;
        $ssc_ball_log->type = $type;
        
        $results = SSC::where('type',$type)->orderby('serial_no','desc')->take(100)->get();
        
        
        $odd_flag = true;
        $even_flag = true;
        $small_flag = true;
        $big_flag = true;
        $tiger_flag = true;
        $dragon_flag = true;
        $non_equal_flag = true;
        $small_repeat_times = 0;
        $big_repeat_times =0;
        $odd_repeat_times =0;
        $even_repeat_times = 0;
        $dragon_repeat_times =0;
        $tiger_repeat_times = 0;
        $non_equal_times =0;

        $ball_odd_even = [];
        $ball_big_small =[];
        $ball_big_repeats = [];
        $ball_small_repeats = [];
        $ball_odd_repeats =[];
        $ball_even_repeats =[];



        $n=0;

        
        foreach($results as $result){

           
            
            if($n==0){
                $ssc_log->src_record_id=$result->id;
                $ssc_ball_log->src_record_id=$result->id;
                
                if($result->total_big==1){
                    $big_flag = true;
                    $small_flag = false;
                    $big_repeat_times =1;
                }else{
                    $big_flag = false;
                    $small_flag = true;
                    $small_repeat_times=1;
                }
                if($result->total_odd==1){
                    $even_flag =false;
                    $odd_flag = true;
                    $odd_repeat_times =1;
                }else{
                    $even_flag =true;
                    $odd_flag = false;
                    $even_repeat_times=1;
                }
                //---each ball initial status 
                //1st ball 
                if($result->ball_1>4)
                {
                    $ball_big_small[0] =1;
                    $ball_big_repeats[0]=1;
                    $ball_small_repeats[0]=0;
                }else{
                    $ball_big_small[0] =-1;
                    $ball_small_repeats[0]=1;
                    $ball_big_repeats[0]=0;
                }

                if(($result->ball_1%2)<>0)
                {
                    $ball_odd_even[0] =1;
                    $ball_odd_repeats[0]=1;
                    $ball_even_repeats[0]=0;
                }else{
                    $ball_odd_even[0] =-1;
                    $ball_even_repeats[0]=1;
                    $ball_odd_repeats[0]=0;
                }
                //2nd ball
                if($result->ball_2>4)
                {
                    $ball_big_small[1] =1;
                    $ball_big_repeats[1]=1;
                    $ball_small_repeats[1]=0;
                }else{
                    $ball_big_small[1] =-1;
                    $ball_small_repeats[1]=1;
                    $ball_big_repeats[1]=0;
                }

                if(($result->ball_2%2)<>0)
                {
                    $ball_odd_even[1] =1;
                    $ball_odd_repeats[1]=1;
                    $ball_even_repeats[1]=0;
                }else{
                    $ball_odd_even[1] =-1;
                    $ball_even_repeats[1]=1;
                    $ball_odd_repeats[1]=0;
                }
                //3rd ball
                if($result->ball_3>4)
                {
                    $ball_big_small[2] =1;
                    $ball_big_repeats[2]=1;
                    $ball_small_repeats[2]=0;
                }else{
                    $ball_big_small[2] =-1;
                    $ball_small_repeats[2]=1;
                    $ball_big_repeats[2]=0;
                }

                if(($result->ball_3%2)<>0)
                {
                    $ball_odd_even[2] =1;
                    $ball_odd_repeats[2]=1;
                    $ball_even_repeats[2]=0;
                }else{
                    $ball_odd_even[2] =-1;
                    $ball_even_repeats[2]=1;
                    $ball_odd_repeats[2]=0;
                }
                //4th ball
                if($result->ball_4>4)
                {
                    $ball_big_small[3] =1;
                    $ball_big_repeats[3]=1;
                    $ball_small_repeats[3]=0;
                }else{
                    $ball_big_small[3] =-1;
                    $ball_small_repeats[3]=1;
                    $ball_big_repeats[3]=0;
                }

                if(($result->ball_4%2)<>0)
                {
                    $ball_odd_even[3] =1;
                    $ball_odd_repeats[3]=1;
                    $ball_even_repeats[3]=0;
                }else{
                    $ball_odd_even[3] =-1;
                    $ball_even_repeats[3]=1;
                    $ball_odd_repeats[3]=0;
                }
                //5th ball
                if($result->ball_5>4)
                {
                    $ball_big_small[4] =1;
                    $ball_big_repeats[4]=1;
                    $ball_small_repeats[4]=0;
                }else{
                    $ball_big_small[4] =-1;
                    $ball_small_repeats[4]=1;
                    $ball_big_repeats[4]=0;
                }

                if(($result->ball_5%2)<>0)
                {
                    $ball_odd_even[4] =1;
                    $ball_odd_repeats[4]=1;
                    $ball_even_repeats[4]=0;
                }else{
                    $ball_odd_even[4] =-1;
                    $ball_even_repeats[4]=1;
                    $ball_odd_repeats[4]=0;
                }
                //ball end

                switch ($result->d_t) {
                    case '龙':
                        $dragon_flag=true;
                        $dragon_repeat_times =1;
                        $tiger_flag=false;
                        $non_equal_flag=true;
                        $non_equal_times=1;
                        break;
                    case '虎':
                        $dragon_flag=false;
                        $tiger_repeat_times =1;
                        $tiger_flag=true;
                        $non_equal_flag=true;
                        $non_equal_times=1;
                        break;
                    case '和':
                        $non_equal_flag = false;
                        $dragon_flag=false;
                        $tiger_flag=false;
                        break;    
                    default:
                        
                        break;
                }

            }else{
                if($big_flag){
                    if($result->total_big==1){
                        $big_repeat_times +=1;
                    }else{
                        $big_flag=false;
                    } 
                }
                if($small_flag){
                    if($result->total_big==1){
                        $small_flag=false;
                    }else{
                        $small_repeat_times +=1;
                    }
                }
                if($odd_flag){
                    if($result->total_odd==1){
                        $odd_repeat_times +=1;
                    }else{
                        $odd_flag=false;
                    } 
                }
                if($even_flag){
                    if($result->total_odd==1){
                        $even_flag=false;
                    }else{
                        $even_repeat_times +=1;
                    }
                }

                if((!$tiger_flag) && (!$dragon_flag) && ($non_equal_flag))
                {
                    switch ($result->d_t) 
                    {
                        case '虎':
                            
                            $non_equal_times +=1;
                            break;
                        case '龙':
                            
                            $non_equal_times +=1;
                            break;
                        case '和':
                            $non_equal_flag = false;
                            $dragon_flag=false;
                            $tiger_flag=false;
                            break;    
                        default:
                            
                            break;
                    }
                  }  
                if($dragon_flag)
                {
                    switch ($result->d_t)
                    {
                        case '龙':
                            $dragon_repeat_times +=1;
                            $non_equal_times +=1;
                            break;
                        case '虎':
                            $dragon_flag=false;
                            $non_equal_times +=1;
                            break;
                        case '和':
                            $non_equal_flag = false;
                            $dragon_flag=false;
                            $tiger_flag=false;
                            break;    
                        default:
                            
                            break;
                    }
                }

                if($tiger_flag)
                {
                    switch ($result->d_t)
                    {
                        case '虎':
                            $tiger_repeat_times +=1;
                            $non_equal_times +=1;
                            break;
                        case '龙':
                            $tiger_flag=false;
                            $non_equal_times +=1;
                            break;
                        case '和':
                            $non_equal_flag = false;
                            $dragon_flag=false;
                            $tiger_flag=false;
                            break;    
                        default:
                            
                            break;
                    }
                }

                //checking each ball .....
                for ($i=0; $i <5 ; $i++) { 
                    if($ball_big_small[$i]==1)
                    {
                        //if big flag
                        if(intval($result->select('ball_'.$i)->get())>4)
                        {
                            //if big
                            $ball_big_repeats[$i] +=1;
                            

                        }else{

                            $ball_big_small[$i]=0；

                        }
                        

                    }elseif($ball_big_small[$i]==-1){
                        //if small
                        switch ($i) {
                            case 0:
                                if(intval($result->ball_1<=4) 
                                {
                                    $ball_small_repeats[$i] +=1;
                                    

                                }else{

                                    $ball_big_small[$i]=0；

                                }
                                break;
                            case 1:
                                # code...
                                break;
                            case 2:
                                # code...
                                break;
                            case 3:
                                # code...
                                break;
                            case 4:
                                # code...
                                break;            
                            default:
                                # code...
                                break;
                        }
                        
                        
                        
                    }

                    if($ball_odd_even[$i]==1)
                    {
                        //if odd flag
                        //if($result->)

                    }

                    
                }
                


                //ball checking ends

            }
            
            $n+=1;
        
        }
        


        $ssc_log->small_repeat_times = $small_repeat_times;
        if($small_repeat_times>=6)
        {
            // Mail::raw('SSC Notification for '.$type.'('.$small_repeat_times.'连小)', 
           //     function($msg) { $msg->to(['james.wang@ylbiz-consulting.com','13501994874@163.com','songhua.lu@189.cn','13701610381@163.com','eric_free2fly@163.com','13701861060@139.com','dsp10886@163.com','wangmib@163.com','assassinwoo@163.com','aking_yang@163.com']); $msg->from('wayhi@163.com','SSC Notification Service'); });

            Self::sendmail($type,'连小',$small_repeat_times);
             
        }
        $ssc_log->big_repeat_times = $big_repeat_times;
        if($big_repeat_times>=6)
        {
             Self::sendmail($type,'连大',$big_repeat_times);
        }
        $ssc_log->odd_repeat_times = $odd_repeat_times;
        if($odd_repeat_times>=6)
        {
             Self::sendmail($type,'连单',$odd_repeat_times);
        }
        $ssc_log->even_repeat_times = $even_repeat_times;
        if($even_repeat_times>=6)
        {
             Self::sendmail($type,'连双',$even_repeat_times);
        }
        $ssc_log->dragon_repeat_times = $dragon_repeat_times;
       /*
        if($dragon_repeat_times>=6)
        {
             Mail::raw('SSC Notification for '.$type.'('.$dragon_repeat_times.'连龙)', 
                function($msg) { $msg->to(['james.wang@ylbiz-consulting.com']); $msg->from(['wayhi@163.com']); });
             
        }*/
        $ssc_log->tiger_repeat_times = $tiger_repeat_times;
        /*if($tiger_repeat_times>=6)
        {
             Mail::raw('SSC Notification for '.$type.'('.$tiger_repeat_times.'连虎)', 
                function($msg) { $msg->to(['james.wang@ylbiz-consulting.com']); $msg->from(['wayhi@163.com']); });
             
        }*/
        $ssc_log->non_equal_times = $non_equal_times;
        /*if($non_equal_times>=28)
        {
             Mail::raw('SSC Notification for '.$type.'('.$non_equal_times.'无和)',  
                function($msg) { $msg->to(['james.wang@ylbiz-consulting.com']); $msg->from(['wayhi@163.com']); });
             
        }*/
        $ssc_log->save();   

    }



    private function load_html_db($url)
    {
        $html =file_get_html($url);
        $n=0;
        foreach ($html->find('tr[class=R_tr]') as $row){
                $type = trim($row->find('td',0)->plaintext);
                if(is_null($row->find('td',1))){
                    
                    return;
                }
                $serial_no = trim($row->find('td',1)->plaintext);
                $record_exist = SSC::where('type',$type)->where('serial_no',$serial_no)->first();
                if($record_exist){

                    break;
                }else{
                    
                    $ssc_record = new SSC;
                    $ssc_record->type = $row->find('td',0)->plaintext;
                    $ssc_record->serial_no = $row->find('td',1)->plaintext;
                    $ssc_record->record_time = $row->find('td',2)->plaintext;
                    $ssc_record->ball_1 = intval(substr($row->find('td',3)->find('img',0)->src,-5,1));
                    $ssc_record->ball_2 = intval(substr($row->find('td',4)->find('img',0)->src,-5,1));
                    $ssc_record->ball_3 = intval(substr($row->find('td',5)->find('img',0)->src,-5,1));
                    $ssc_record->ball_4 = intval(substr($row->find('td',6)->find('img',0)->src,-5,1));
                    $ssc_record->ball_5 = intval(substr($row->find('td',7)->find('img',0)->src,-5,1));
                    $str1 = explode('/',$row->find('td',8)->plaintext);
                    $ssc_record->total_num = intval($str1[0]);
                    if(trim($str1[1])=='总和大'){
                        $ssc_record->total_big = 1;
                        

                    }elseif(trim($str1[1])=='总和小'){
                        $ssc_record->total_big = 0;
                        
                    }
                    if(trim($str1[2])=='总和单'){
                        $ssc_record->total_odd = 1;
                        
                    }elseif(trim($str1[2])=='总和双'){
                        $ssc_record->total_odd = 0;
                        
                    }
                    
                    $d_t = trim($row->find('td',9)->plaintext);
                    $ssc_record->d_t = $d_t;

                    

                    $ssc_record->extra_1 = $row->find('td',10)->plaintext;
                    $ssc_record->extra_2 = $row->find('td',11)->plaintext;
                    
                    $ssc_record->save();
                    $n+=1;
                }
                

            }

            if($n>0){

                Self::cal_state($type);
            }


    }

    private function sendmail($type,$event,$times)
    {
        $group = Group::where('name','VIPs')->first();
        
        $mailtolist =[];
        $n=0;
        foreach($group->users as $user)
        {
            
            //$mailtolist = array_push($mailtolist,$user->email);
            $mailtolist = array_add($mailtolist,$n,$user->email);
            $n+=1;
            //echo $user->email;
        }
        Mail::raw('SSC Notification for '.$type.'('.$times.$event.')', 
                function($msg) use ($mailtolist){ $msg->to(['wayhi@163.com']);$msg->bcc($mailtolist); 
                 $msg->subject('SSC Notification');$msg->from('wayhi@163.com','SSC Notification Service'); });

    }

             
}