<?php

namespace App\Http\Controllers;

use App\Buyinghistory;
use App\Saleitem;
use DateTime;
use Illuminate\Http\Request;

class GraphController extends Controller
{
    public function getBuyAllMonth(){
        $months=[];
        $sale=Buyinghistory::orderBy('created_at', 'ASC')->pluck('created_at');
        $s=json_decode($sale);
        if(!empty($s)){
            foreach ($s as $ufs){
                $fs=new DateTime($ufs->date);
                $f_name=$fs->format("M");
                $f_no=$fs->format("m");
                $months[$f_no]=$f_name;
            }
        }
        return $months;
    }
    public function getBuyMonthCount($m){
        $sale=Buyinghistory::whereMonth('created_at', $m)->get()->count();
        return $sale;
    }
    public function getMonthBuy(){
        $myData=[];
        $allM=$this->getBuyAllMonth();
        if(!empty($allM)){
            foreach ($allM as $m_no=>$m_name){
                $sale=$this->getBuyMonthCount($m_no);
                array_push($myData, $sale);
            }
        }
        $myMonth=[];
        $months=$this->getBuyAllMonth();
        if(!empty($months)){
            foreach ($months as $n=>$m){
                array_push($myMonth, $m);
            }
        }

        $ok=["months"=>$myMonth, "buy_month_count"=>$myData];
        return $ok;
    }
    public function getAllMonth(){
        $months=[];
        $sale=Saleitem::orderBy('created_at', 'ASC')->pluck('created_at');
        $s=json_decode($sale);
        if(!empty($s)){
            foreach ($s as $ufs){
                $fs=new DateTime($ufs->date);
                $f_name=$fs->format("M");
                $f_no=$fs->format("m");
                $months[$f_no]=$f_name;
            }
        }
        return $months;
    }
    public function getMonthSaleCount($m){
        $sale=Saleitem::whereMonth('created_at', $m)->get()->count();
        return $sale;
    }
    public function getMonthlySale(){
        $myData=[];
        $allM=$this->getAllMonth();
        if(!empty($allM)){
            foreach ($allM as $m_no=>$m_name){
                $sale=$this->getMonthSaleCount($m_no);
                array_push($myData, $sale);
            }
        }
        $myMonth=[];
        $months=$this->getAllMonth();
        if(!empty($months)){
            foreach ($months as $n=>$m){
                array_push($myMonth, $m);
            }
        }

        $ok=["months"=>$myMonth, "sale_count_data"=>$myData];
        return $ok;

    }
}
