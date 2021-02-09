<?php 
//  @author Vijay
class Site {
    var $ci = null;
    public function __get($var) {
        return get_instance()->$var;
    }

    public function __construct() {
        $this->ci = &get_instance();
    }
    public function get_live_glod_rate(){
        $res = $this->db->select('GOLD_BUY,GOLD_SELL')->from('GOLD_RATE_MASTER')->where('ID',1)->get()->row();
        $g = $this->db->select('BUY_GST_PERCENT,SELL_GST_PERCENT,DELIVERY_RATE')->from('GST_MASTER')->where('ID',1)->get()->row();
        
        $buy = number_format($res->GOLD_BUY, 2, '.', '');
        $sell = number_format($res->GOLD_SELL, 2, '.', '');
        $gst_buy=number_format($g->BUY_GST_PERCENT, 2, '.', '');
        $convert=number_format($buy/10, 2, '.', '');   
        return array('buy'=>$buy,'sell'=>$sell,'buy_gst'=>$gst_buy,'gram_rate'=>$convert);
    }
}