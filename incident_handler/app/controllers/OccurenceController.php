<?php


class OccurenceController extends Controller {
protected $layout = 'layouts.master';

    public function query($id){
      if ($this->validateIpAddress($id)){
        $occurence = Occurence::where("ip" , '=' , $id)->first();
        return $this->layout = View::make("occurence.query", array(
        'occurence'=>$occurence,
        ));
      }

    }
    public function validateIpAddress($ip_addr){
        $result = true;
        if(preg_match("/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/",$ip_addr)){
            $parts=explode(".",$ip_addr);
            foreach($parts as $ip_parts){
                if(intval($ip_parts)>255 || intval($ip_parts)<0)
                    $result=false;
            }
            if (intval($parts[0])==0 || intval($parts[0])==10 || intval($parts[0])==127 || (intval($parts[0])>223 && intval($parts[0])<240)){
                $result=false;
            }
            if ((intval($parts[0])==192 && intval($parts[1])==168) || (intval($parts[0])==169 && intval($parts[1])==254)){
                $result=false;
            }
            if (intval($parts[0])==172 && intval($parts[1])>15 && intval($parts[1])<32 ){
                $result=false;
            }
        }
        else{
            $result = false; //if format of ip address doesn't matches
        }
        return $result;
    }
}





 ?>
