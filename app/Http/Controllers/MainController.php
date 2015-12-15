<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request, Mail;
use App\SSC, App\Ssc_number_appearance,App\Ssc_log,App\User,App\Ssc_ball_log,App\Group;
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

        $url=['CQ'=>'/app/member/Lottery/list.php',
              'JX'=>'/app/member/Lottery/list_jxssc.php',
        ];
        $hosts_pool = ['http://www.hg7277.com',
        'http://www.hg5789.com',
        'http://www.hg7377.com',
        'http://www.hg0789.com',
        'http://www.hg2789.com',
        'http://www.hg3789.com',
        'http://www.hg3868.com',
        'http://www.cr007.com',
        'http://www.hg29.com',
        'http://www.996699.cc'
        ];
        //$host = $hosts_pool[rand(0,9)];

            Self::load_html_db($hosts_pool[rand(0,9)].$url['CQ'],'重庆时时彩');
            //Self::load_html_db($hosts_pool[rand(0,10)].$url['TJ']);
            Self::load_html_db($hosts_pool[rand(0,9)].$url['JX'],'江西时时彩');



    }
    public function cal_state($type='重庆时时彩')
    {

        
        $ssc_log = new Ssc_log;
        $ssc_log->type = $type;
        $ssc_ball_log = new Ssc_ball_log;
        $ssc_ball_log->type = $type;
        
        $results = SSC::where('type',$type)->orderby('serial_no','desc')->take(100)->get();
        $last_log = Ssc_log::where('type',$type)->orderby('id','desc')->first();
        
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

        $ssc_number_missed = new Ssc_number_missed;
        $num_missed_times = [];
        for ($i=0; $i < 10; $i++) { 
            $num_missed_times[$i] = 1;
        }

        $n=0;

        
        foreach($results as $result){

           $num_missed_times[$result->ball_1]=0;
           $num_missed_times[$result->ball_2]=0;
           $num_missed_times[$result->ball_3]=0;
           $num_missed_times[$result->ball_4]=0;
           $num_missed_times[$result->ball_5]=0;
           for ($i=0; $i < 10; $i++) { 
                if($num_missed_times[$i] > 1)
                {
                    $num_missed_times[$i] =+1;
                }
            }
 
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
                        switch ($i) {
                            case 0:
                                if(intval($result->ball_1)>4)
                                {
                                    $ball_big_repeats[$i] +=1;
                                    

                                }else{

                                    $ball_big_small[$i]=0;

                                }
                                break;
                            case 1:
                                if(intval($result->ball_2)>4)
                                {
                                    $ball_big_repeats[$i] +=1;
                                    

                                }else{

                                    $ball_big_small[$i]=0;

                                }
                                break;    
                            case 2:
                                if(intval($result->ball_3)>4)
                                {
                                    $ball_big_repeats[$i] +=1;
                                    

                                }else{

                                    $ball_big_small[$i]=0;

                                }
                                break;
                            case 3:
                                if(intval($result->ball_4)>4)
                                {
                                    $ball_big_repeats[$i] +=1;
                                    

                                }else{

                                    $ball_big_small[$i]=0;

                                }
                                break;
                            case 4:
                                if(intval($result->ball_5)>4)
                                {
                                    $ball_big_repeats[$i] +=1;
                                    

                                }else{

                                    $ball_big_small[$i]=0;

                                }
                                break;        
                            default:
                                
                                break;
                                                
                            }
                    }elseif($ball_big_small[$i]==-1){
                        //if small
                        switch ($i) {
                            case 0:
                                if(intval($result->ball_1)<=4)
                                {
                                    $ball_small_repeats[$i] +=1;
                                    

                                }else{

                                    $ball_big_small[$i]=0;

                                }

                                break;
                            case 1:
                                if(intval($result->ball_2)<=4)
                                {
                                    $ball_small_repeats[$i] +=1;
                                    

                                }else{

                                    $ball_big_small[$i]=0;

                                }
                                break;
                            case 2:
                                if(intval($result->ball_3)<=4)
                                {
                                    $ball_small_repeats[$i] +=1;
                                    

                                }else{

                                    $ball_big_small[$i]=0;

                                }
                                break;
                            case 3:
                                if(intval($result->ball_4)<=4)
                                {
                                    $ball_small_repeats[$i] +=1;
                                    

                                }else{

                                    $ball_big_small[$i]=0;

                                }
                                break;
                            case 4:
                                if(intval($result->ball_5)<=4)
                                {
                                    $ball_small_repeats[$i] +=1;
                                    

                                }else{

                                    $ball_big_small[$i]=0;

                                }
                                break;            
                            default:    
                            break;
                        }
                        

                    }

                    if($ball_odd_even[$i]==1)
                    {
                        switch ($i) {
                            case 0:
                                if(intval($result->ball_1)%2 != 0)
                                {
                                    $ball_odd_repeats[$i] +=1;

                                }else{

                                    $ball_odd_even[$i] =0;
                                }
                                break;
                            case 1:
                                if(intval($result->ball_2)%2 != 0)
                                {
                                    $ball_odd_repeats[$i] +=1;

                                }else{

                                    $ball_odd_even[$i] =0;
                                }
                                break;
                            case 2:
                                if(intval($result->ball_3)%2 != 0)
                                {
                                    $ball_odd_repeats[$i] +=1;

                                }else{

                                    $ball_odd_even[$i] =0;
                                }
                                break;
                            case 3:
                                if(intval($result->ball_4)%2 != 0)
                                {
                                    $ball_odd_repeats[$i] +=1;

                                }else{

                                    $ball_odd_even[$i] =0;
                                }
                                break;
                            case 4:
                                if(intval($result->ball_5)%2 != 0)
                                {
                                    $ball_odd_repeats[$i] +=1;

                                }else{

                                    $ball_odd_even[$i] =0;
                                }
                                break;            
                            default:
                                
                                break;
                        }

                    }elseif($ball_odd_even[$i]==-1){
                        switch($i) {
                            case 0:
                                if(intval($result->ball_1)%2 == 0)
                                {
                                    $ball_even_repeats[$i] +=1;

                                }else{

                                    $ball_odd_even[$i] =0;
                                }
                                break;
                            case 1:
                                if(intval($result->ball_2)%2 == 0)
                                {
                                    $ball_even_repeats[$i] +=1;

                                }else{

                                    $ball_odd_even[$i] =0;
                                }
                                break;    
                            
                            case 2:
                                if(intval($result->ball_3)%2 == 0)
                                {
                                    $ball_even_repeats[$i] +=1;

                                }else{

                                    $ball_odd_even[$i] =0;
                                }
                                break;
                            case 3:
                                if(intval($result->ball_4)%2 == 0)
                                {
                                    $ball_even_repeats[$i] +=1;
                                    

                                }else{

                                    $ball_odd_even[$i] =0;
                                }
                                break;    
                            case 4:
                                if(intval($result->ball_5)%2 == 0)
                                {
                                    $ball_even_repeats[$i] +=1;

                                }else{

                                    $ball_odd_even[$i] =0;
                                }
                                break;    
                                    
                            
                            default:
                                
                                break;
                        }

                    }

                    
                }
                


                //ball checking ends

            }
            
            $n+=1;
        
        }
        

        $items=[];
        $times=[];
        $events=[];
        $i=0;
        $ssc_log->small_repeat_times = $small_repeat_times;
        if($small_repeat_times==1)
        {
            //big-small status changed...
            $last_log->bs_flag=1;
            $last_log->save();
        }elseif($small_repeat_times>=6)
        {
            
            $items = array_add($items,$i,'总和');
            $times = array_add($times,$i,$small_repeat_times);
            $events= array_add($events,$i,'连小');
            $i+=1; 
        }
        $ssc_log->big_repeat_times = $big_repeat_times;
        if($big_repeat_times==1)
        {
            //big-small status changed...
            $last_log->bs_flag=1;
            $last_log->save();
        }elseif($big_repeat_times>=6)
        {
            //Self::sendmail($type,'连大',$big_repeat_times);
            $items = array_add($items,$i,'总和');
            $times = array_add($times,$i,$big_repeat_times);
            $events= array_add($events,$i,'连大');
            $i+=1; 
        }
        $ssc_log->odd_repeat_times = $odd_repeat_times;
        if($odd_repeat_times==1)
        {
             //odd-even status changed...
            $last_log->oe_flag=1;
            $last_log->save();
        }elseif($odd_repeat_times>=6)
        {
             //Self::sendmail($type,'连单',$odd_repeat_times);
            $items = array_add($items,$i,'总和');
            $times = array_add($times,$i,$odd_repeat_times);
            $events= array_add($events,$i,'连单');
            $i+=1; 
        }
        $ssc_log->even_repeat_times = $even_repeat_times;
        if($even_repeat_times==1)
        {
             //odd-even status changed...
            $last_log->oe_flag=1;
            $last_log->save();
        }elseif($even_repeat_times>=6)
        {
            //Self::sendmail($type,'连双',$even_repeat_times);
            $items = array_add($items,$i,'总和');
            $times = array_add($times,$i,$even_repeat_times);
            $events= array_add($events,$i,'连双');
            $i+=1; 
        }
        $ssc_log->dragon_repeat_times = $dragon_repeat_times;
       
        $ssc_log->tiger_repeat_times = $tiger_repeat_times;
        
        $ssc_log->non_equal_times = $non_equal_times;
        

        $ssc_log->save();


        $ssc_ball_log->odd_repeat_times_1 = $ball_odd_repeats[0];
        if($ball_odd_repeats[0]>=10){
            $items = array_add($items,$i,'第1球(万位)');
            $times = array_add($times,$i,$ball_odd_repeats[0]);
            $events= array_add($events,$i,'连单');
            $i+=1; 
        }
        $ssc_ball_log->even_repeat_times_1 = $ball_even_repeats[0];
        if($ball_even_repeats[0]>=10){
            $items = array_add($items,$i,'第1球(万位)');
            $times = array_add($times,$i,$ball_even_repeats[0]);
            $events= array_add($events,$i,'连双');
            $i+=1; 
        }
        $ssc_ball_log->big_repeat_times_1 = $ball_big_repeats[0];
        if($ball_big_repeats[0]>=10){
            $items = array_add($items,$i,'第1球(万位)');
            $times = array_add($times,$i,$ball_big_repeats[0]);
            $events= array_add($events,$i,'连大');
            $i+=1; 
        }
        $ssc_ball_log->small_repeat_times_1 = $ball_small_repeats[0];
        if($ball_small_repeats[0]>=10){
            $items = array_add($items,$i,'第1球(万位)');
            $times = array_add($times,$i,$ball_small_repeats[0]);
            $events= array_add($events,$i,'连小');
            $i+=1; 
        }
        $ssc_ball_log->odd_repeat_times_2 = $ball_odd_repeats[1];
        if($ball_odd_repeats[1]>=10){
            $items = array_add($items,$i,'第2球(千位)');
            $times = array_add($times,$i,$ball_odd_repeats[1]);
            $events= array_add($events,$i,'连单');
            $i+=1; 
        }
        $ssc_ball_log->even_repeat_times_2 = $ball_even_repeats[1];
        if($ball_even_repeats[1]>=10){
            $items = array_add($items,$i,'第2球(千位)');
            $times = array_add($times,$i,$ball_even_repeats[1]);
            $events= array_add($events,$i,'连双');
            $i+=1; 
        }
        $ssc_ball_log->big_repeat_times_2 = $ball_big_repeats[1];
        if($ball_big_repeats[1]>=10){
            $items = array_add($items,$i,'第2球(千位)');
            $times = array_add($times,$i,$ball_big_repeats[1]);
            $events= array_add($events,$i,'连大');
            $i+=1; 
        }
        $ssc_ball_log->small_repeat_times_2 = $ball_small_repeats[1];
        if($ball_small_repeats[1]>=10){
            $items = array_add($items,$i,'第2球(千位)');
            $times = array_add($times,$i,$ball_small_repeats[1]);
            $events= array_add($events,$i,'连小');
            $i+=1; 
        }

        $ssc_ball_log->odd_repeat_times_3 = $ball_odd_repeats[2];
        if($ball_odd_repeats[2]>=10){
            $items = array_add($items,$i,'第3球(百位)');
            $times = array_add($times,$i,$ball_odd_repeats[2]);
            $events= array_add($events,$i,'连单');
            $i+=1; 
        }
        $ssc_ball_log->even_repeat_times_3 = $ball_even_repeats[2];
        if($ball_even_repeats[2]>=10){
            $items = array_add($items,$i,'第3球(百位)');
            $times = array_add($times,$i,$ball_even_repeats[2]);
            $events= array_add($events,$i,'连双');
            $i+=1; 
        }
        $ssc_ball_log->big_repeat_times_3 = $ball_big_repeats[2];
        if($ball_big_repeats[2]>=10){
            $items = array_add($items,$i,'第3球(百位)');
            $times = array_add($times,$i,$ball_big_repeats[2]);
            $events= array_add($events,$i,'连大');
            $i+=1; 
        }
        $ssc_ball_log->small_repeat_times_3 = $ball_small_repeats[2];
        if($ball_small_repeats[2]>=10){
            $items = array_add($items,$i,'第3球(百位)');
            $times = array_add($times,$i,$ball_small_repeats[2]);
            $events= array_add($events,$i,'连小');
            $i+=1; 
        }

        $ssc_ball_log->odd_repeat_times_4 = $ball_odd_repeats[3];
        if($ball_odd_repeats[3]>=10){
            $items = array_add($items,$i,'第4球(十位)');
            $times = array_add($times,$i,$ball_odd_repeats[3]);
            $events= array_add($events,$i,'连单');
            $i+=1; 
        }
        $ssc_ball_log->even_repeat_times_4 = $ball_even_repeats[3];
        if($ball_even_repeats[3]>=10){
            $items = array_add($items,$i,'第4球(十位)');
            $times = array_add($times,$i,$ball_even_repeats[3]);
            $events= array_add($events,$i,'连双');
            $i+=1; 
        }
        $ssc_ball_log->big_repeat_times_4 = $ball_big_repeats[3];
        if($ball_big_repeats[3]>=10){
            $items = array_add($items,$i,'第4球(十位)');
            $times = array_add($times,$i,$ball_big_repeats[3]);
            $events= array_add($events,$i,'连大');
            $i+=1; 
        }
        $ssc_ball_log->small_repeat_times_4 = $ball_small_repeats[3];
        if($ball_small_repeats[3]>=10){
            $items = array_add($items,$i,'第4球(十位)');
            $times = array_add($times,$i,$ball_small_repeats[3]);
            $events= array_add($events,$i,'连小');
            $i+=1; 
        }
        $ssc_ball_log->odd_repeat_times_5 = $ball_odd_repeats[4];
        if($ball_odd_repeats[4]>=10){
            $items = array_add($items,$i,'第5球(个位)');
            $times = array_add($times,$i,$ball_odd_repeats[4]);
            $events= array_add($events,$i,'连单');
            $i+=1; 
        }
        $ssc_ball_log->even_repeat_times_5 = $ball_even_repeats[4];
        if($ball_even_repeats[4]>=10){
            $items = array_add($items,$i,'第5球(个位)');
            $times = array_add($times,$i,$ball_even_repeats[4]);
            $events= array_add($events,$i,'连双');
            $i+=1; 
        }
        $ssc_ball_log->big_repeat_times_5 = $ball_big_repeats[4];
        if($ball_big_repeats[4]>=10){
            $items = array_add($items,$i,'第5球(个位)');
            $times = array_add($times,$i,$ball_big_repeats[4]);
            $events= array_add($events,$i,'连大');
            $i+=1; 
        }
        $ssc_ball_log->small_repeat_times_5 =$ball_small_repeats[4];
        if($ball_small_repeats[4]>=10){
            $items = array_add($items,$i,'第5球(个位)');
            $times = array_add($times,$i,$ball_small_repeats[4]);
            $events= array_add($events,$i,'连小');
            $i+=1; 
        }
        $ssc_ball_log->save();
        if(count($items)>0){
            Self::sendmail2($type,$items,$events,$times);  
        }
         

    }



    private function load_html_db($url,$type)
    {
        $html =file_get_html($url);
        $n=0;
        foreach ($html->find('tr[class=line_list]') as $row){

            if($n==0){
                    $n+=1;
            }else{
                    
                    if(is_null($row->find('td',1))){
                    
                        return;
                    }

                
                    $serial_no = trim($row->find('td',1)->plaintext);
                    $record_exist = SSC::where('type',$type)->where('serial_no',$serial_no)->first();
                    if($record_exist){

                        break;
                    }else{
                        
                        $ssc_record = new SSC;
                        $ssc_record->type = $type;
                        $ssc_record->serial_no = trim($row->find('td',1)->plaintext);
                        //$ssc_record->record_time = $row->find('td',2)->plaintext;
                        $ssc_record->ball_1 = intval(substr($row->find('td',2)->find('img',0)->src,-5,1));
                        $ssc_record->ball_2 = intval(substr($row->find('td',2)->find('img',1)->src,-5,1));
                        $ssc_record->ball_3 = intval(substr($row->find('td',2)->find('img',2)->src,-5,1));
                        $ssc_record->ball_4 = intval(substr($row->find('td',2)->find('img',3)->src,-5,1));
                        $ssc_record->ball_5 = intval(substr($row->find('td',2)->find('img',4)->src,-5,1));
                        $str1 = explode('/',$row->find('td',3)->plaintext);
                        $ssc_record->total_num = intval($str1[0]);
                        if(trim($str1[1])=='大'){
                            $ssc_record->total_big = 1;
                            

                        }elseif(trim($str1[1])=='小'){
                            $ssc_record->total_big = 0;
                            
                        }
                        if(trim($str1[2])=='单'){
                            $ssc_record->total_odd = 1;
                            
                        }elseif(trim($str1[2])=='双'){
                            $ssc_record->total_odd = 0;
                            
                        }
                        
                        $d_t = trim($row->find('td',4)->plaintext);
                        $ssc_record->d_t = $d_t;

                        $ssc_record->extra_1 = $row->find('td',5)->plaintext;
                        $ssc_record->extra_2 = $row->find('td',6)->plaintext;
                        
                        $ssc_record->save();
                        $n+=1;
                        $ssc_number_apr = new Ssc_number_appearance;
                        $data = Self::apr_count($ssc_record->type,10);
                        $ssc_number_apr->type = $ssc_record->type;
                        $ssc_number_apr->period = 10;
                        $ssc_number_apr->src_record_id = $ssc_record->id;
                        $ssc_number_apr->apr_times_0 = $data[0];
                        $ssc_number_apr->apr_times_1 = $data[1];
                        $ssc_number_apr->apr_times_2 = $data[2];
                        $ssc_number_apr->apr_times_3 = $data[3];
                        $ssc_number_apr->apr_times_4 = $data[4];
                        $ssc_number_apr->apr_times_5 = $data[5];
                        $ssc_number_apr->apr_times_6 = $data[6];
                        $ssc_number_apr->apr_times_7 = $data[7];
                        $ssc_number_apr->apr_times_8 = $data[8];
                        $ssc_number_apr->apr_times_9 = $data[9];
                        $ssc_number_apr->save();
                        
                    }

                    
                }

                

            }

        
        if($n>1){

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


    private function sendmail2($type,$items,$events,$times)
    {

        $group = Group::where('name','VIPs')->first();
        
        $maillist =[];
        $n=0;
        foreach($group->users as $user)
        {
            
            //$mailtolist = array_push($mailtolist,$user->email);
            $maillist = array_add($maillist,$n,$user->email);
            $n+=1;
           
        }

        $data = ['email'=>$maillist,'type'=>$type,'items'=>$items,'times'=>$times,'events'=>$events];
        Mail::send('notification', $data, function($message) use($data){
            $message->to(['wayhi@163.com'])->bcc($data['email'])->subject($data['type'].':'.$data['items'][0].$data['times'][0].$data['events'][0])->from('wayhi@163.com','SSC Notification Service');
        });



    }

    private function apr_count($type,$qty)
    {
        $records = SSC::where('type',$type)->orderby('serial_no','desc')->take($qty)->get();
        $count_arr = [];

        for ($i=0; $i <10 ; $i++) { 
            $count_arr[$i]=0;
        }
        //$count_arr[0] = 0;
        foreach($records as $record)
        {
            
            switch (intval($record->ball_1)) {
                case 0:
                    $count_arr[0] +=1;
                    break;
                case 1:
                    $count_arr[1] +=1;
                    break;
                case 2:
                    $count_arr[2] +=1;
                    break;  
                case 3:
                    $count_arr[3] +=1;
                    break;  
                case 4:
                    $count_arr[4] +=1;
                    break;  
                case 5:
                    $count_arr[5] +=1;
                    break; 
                case 6:
                    $count_arr[6] +=1;
                    break; 
                case 7:
                    $count_arr[7] +=1;
                    break;
                case 8:
                    $count_arr[8] +=1;
                    break;  
                case 9:
                    $count_arr[9] +=1;
                    break;                      
                default:
                    
                    break;
            }
            switch (intval($record->ball_2)) {
                case 0:
                    $count_arr[0] +=1;
                    break;
                case 1:
                    $count_arr[1] +=1;
                    break;
                case 2:
                    $count_arr[2] +=1;
                    break;  
                case 3:
                    $count_arr[3] +=1;
                    break;  
                case 4:
                    $count_arr[4] +=1;
                    break;  
                case 5:
                    $count_arr[5] +=1;
                    break; 
                case 6:
                    $count_arr[6] +=1;
                    break; 
                case 7:
                    $count_arr[7] +=1;
                    break;
                case 8:
                    $count_arr[8] +=1;
                    break;  
                case 9:
                    $count_arr[9] +=1;
                    break;                      
                default:
                    
                    break;
            }
            switch (intval($record->ball_3)) {
                case 0:
                    $count_arr[0] +=1;
                    break;
                case 1:
                    $count_arr[1] +=1;
                    break;
                case 2:
                    $count_arr[2] +=1;
                    break;  
                case 3:
                    $count_arr[3] +=1;
                    break;  
                case 4:
                    $count_arr[4] +=1;
                    break;  
                case 5:
                    $count_arr[5] +=1;
                    break; 
                case 6:
                    $count_arr[6] +=1;
                    break; 
                case 7:
                    $count_arr[7] +=1;
                    break;
                case 8:
                    $count_arr[8] +=1;
                    break;  
                case 9:
                    $count_arr[9] +=1;
                    break;                      
                default:
                    
                    break;
            }
            switch (intval($record->ball_4)) {
                case 0:
                    $count_arr[0] +=1;
                    break;
                case 1:
                    $count_arr[1] +=1;
                    break;
                case 2:
                    $count_arr[2] +=1;
                    break;  
                case 3:
                    $count_arr[3] +=1;
                    break;  
                case 4:
                    $count_arr[4] +=1;
                    break;  
                case 5:
                    $count_arr[5] +=1;
                    break; 
                case 6:
                    $count_arr[6] +=1;
                    break; 
                case 7:
                    $count_arr[7] +=1;
                    break;
                case 8:
                    $count_arr[8] +=1;
                    break;  
                case 9:
                    $count_arr[9] +=1;
                    break;                      
                default:
                    
                    break;
            }
            switch (intval($record->ball_5)) {
                case 0:
                    $count_arr[0] +=1;
                    break;
                case 1:
                    $count_arr[1] +=1;
                    break;
                case 2:
                    $count_arr[2] +=1;
                    break;  
                case 3:
                    $count_arr[3] +=1;
                    break;  
                case 4:
                    $count_arr[4] +=1;
                    break;  
                case 5:
                    $count_arr[5] +=1;
                    break; 
                case 6:
                    $count_arr[6] +=1;
                    break; 
                case 7:
                    $count_arr[7] +=1;
                    break;
                case 8:
                    $count_arr[8] +=1;
                    break;  
                case 9:
                    $count_arr[9] +=1;
                    break;                      
                default:
                    
                    break;
            }
        }

       return $count_arr; 

    }

    public function bet_simulation()
    {

        $type = '重庆时时彩';
        $results = SSC::where('type',$type)->orderby('serial_no')->get();
        $bet_amount =100.00;
        $max_bet =100.00;
        $max_bet_record ='';
        $balance = 0.00;
        $bs_last = 0;
        $oe_last =0;
        $bs =0;
        $oe=0;
        $n=0;
        $bet_times=1;
        foreach ($results as $result) {
            
            if($n==0)
            {
                $bs_last = $result->total_big;
                $oe_last = $result->total_odd;
            }
            if($n>0)
            {
                $bs = $result->total_big;
                $oe = $result->total_odd;
                //win-win
                if(($bs==$bs_last) && ($oe==$oe_last))
                {
                    $balance += $bet_amount*0.98;
                    $bet_amount = 100.00;
                   echo 'win!'.$result->serial_no.'--<br>';
                   
                }elseif(($bs==$bs_last) && ($oe!=$oe_last)){
                    //win-lose
                    $balance += $bet_amount*(-0.02);

                }elseif(($bs!=$bs_last) && ($oe==$oe_last)){

                    $balance += $bet_amount*(-0.02);
                }elseif(($bs!=$bs_last) && ($oe!=$oe_last)){
                    //if($bet_times<=6400000)
                    //{
                        $balance += $bet_amount*(-1);
                        $bet_amount = $bet_amount*2;
                        //$bet_times = $bet_times *2;
                        if($bet_amount>$max_bet)
                        {
                            $max_bet = $bet_amount;
                            $max_bet_record = $result->serial_no;
                        }
                        /*
                    }else{
                        $balance += $bet_amount*(-1);
                        if($bet_amount>$max_bet)
                        {
                            $max_bet = $bet_amount;
                            $max_bet_record = $result->serial_no;
                        }
                        $bet_amount = 100.00;
                        $bet_times =1;
                       
                    }
                    */
                    
                    
                }
                //if($balance>=5000){
                //    $porfit +=$balance;
                //    $balance = 0.00;

                //}
                $bs_last = $bs;
                $oe_last = $oe;
                
            }
            $n +=1;


        }

        echo 'porfit:'.$balance.'; ';
        echo 'Max Bet:'.$max_bet.'; ';
        echo 'Max Bet Round: '.$max_bet_record.'; ';
    }

    public function Simulate_CQ_Bai($column=3,$times=2)
    {

        $type = '重庆时时彩';
        $start_no='20150810024';
        $results = SSC::where('type',$type)->where('serial_no','>=',$start_no)->orderby('serial_no')->take(500)->get();
        $base_bet =100.00;
        $bet_times = 9.8;
        $balance = 0.00;
        $base_ball = 0;
        $win_current = false;
        $n=0;
        $last_serial_no ='';
        $repeat_times = $times;
        foreach ($results as $result) {

            if($n==0){

                $base_ball = $result->ball_3;
                $last_serial_no = $result->serial_no;

            }else{
                if($result->serial_no == $last_serial_no){
                    $result->delete();

                }else{
                    if($base_ball==$result->ball_1){
                        $balance += $base_bet*($bet_times-1);
                        $win_current = true;
                    }else{
                        $balance -=$base_bet;

                    }
                    if($base_ball==$result->ball_2){
                        $balance +=$base_bet*($bet_times-1);
                        $win_current = true;
                    }else{
                        $balance -=$base_bet;

                    }
                    if($base_ball==$result->ball_3){
                        $balance +=$base_bet*($bet_times-1);
                        $win_current = true;
                    }else{
                        $balance -=$base_bet;

                    }
                    if($base_ball==$result->ball_4){
                        $balance +=$base_bet*($bet_times-1);
                        $win_current = true;
                    }else{
                        $balance -=$base_bet;

                    }
                    if($base_ball==$result->ball_5){
                        $balance +=$base_bet*($bet_times-1);
                        $win_current = true;
                    }else{
                        $balance -=$base_bet;

                    }

                    $last_serial_no = $result->serial_no;
                }
                

            }

            if($win_current)
            {
                $win_current=false;
                $base_ball = $result->ball_3;
            }else{
                $repeat_times -= 1;
                if($repeat_times<=0){
                    $base_ball = $result->ball_3;
                }
            }
            $n += 1;

        }

        echo 'porfit:'.$balance.'; ';


    }
             
}