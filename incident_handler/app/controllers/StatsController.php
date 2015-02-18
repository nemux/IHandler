<?php

class StatsController extends Controller {
protected $layout = 'layouts.master';
    /**
     * Muestra el perfil de un usuario dado.
     */
    public function incident()
    {

        return $this->layout = View::make("stats.incident", array(

        ));

    }
    public function incidentGraph()
    {
        $input=Input::all();
        $option=$input['option'];
        $incidents=null;

        if ($input['start']!='' && $input['end']) {
          $start=explode("/",$input['start'])[2]."-".explode("/",$input['start'])[0]."-".explode("/",$input['start'])[1];
          $end=explode("/",$input['end'])[2]."-".explode("/",$input['end'])[0]."-".explode("/",$input['end'])[1];
          if ($option==1) {

            $incidents=DB::select(DB::raw(" select count(*), extract(month from t.datetime) as month
                                            from incidents as i, time as t
                                            where i.id=t.incidents_id and
                                            t.time_types_id=1
                                            and t.datetime between '".$start."' and '".$end."'
                                            group by month order by month asc"));
          }else if ($option==2) {

            $incidents=DB::select(DB::raw(" select count(*), date_trunc('day',t.datetime) as date
                                            from incidents as i, time as t
                                            where i.id=t.incidents_id and
                                            t.time_types_id=1
                                            and t.datetime between '".$start."' and '".$end."'
                                            group by date order by date asc"));
          }
          return $this->layout = View::make("stats._incident", array(
            'incidents'=>$incidents,
            'option'=>$option,

          ));
        }
    }
    public function ip()
    {

        return $this->layout = View::make("stats.ip", array(

        ));

    }
    public function ipGraph()
    {
        $input=Input::all();


        if ($input['top']!='' && $input['src_dst'] && $input['customer']!='' && $input['blacklist']) {
          $top=$input['top'];
          $src_dst=$input['src_dst'];
          $customer=$input['customer'];
          $blacklist=$input['blacklist'];
          $join_occurence="";
          if ($src_dst==1) {
            $join_occurrence="io.source_id=o.id";
          }else if ($src_dst==2) {
            $join_occurrence="io.destiny_id=o.id";
          }
          if ($blacklist==1) {
            $join_occurrence="io.source_id=o.id";
          }else if ($blacklist==2) {
            $join_occurrence="io.destiny_id=o.id";
          }

          $incidents=DB::select(DB::raw(" select
                                            o.id,
                                            o.ip as ip,
                                            oh.occurences_id,
                                            count(*) as appear,
                                            c.name
                                          from
                                            occurrences as o
                                              inner join
                                            occurences_history as oh
                                              on
                                            o.id=oh.occurences_id
                                              inner join
                                            incidents_occurences as io
                                              on
                                            ".$join_occurrence."
                                              inner join
                                            incidents as i
                                              on
                                            i.id=io.incidents_id
                                              inner join
                                            customers as c
                                              on
                                            c.id=i.customers_id
                                          where
                                            o.ip not like ''
                                            and
                                            c.id=".$customer."
                                          group by
                                            o.id,oh.occurences_id,c.name
                                          order by
                                            appear desc
                                            ;
                                        "));

          return $this->layout = View::make("ip._ip", array(
            'ip'=>$ip,
            'top'=>$top,
            'src_dst'=>$src_dst,
            'customer'=>$customer,
            'blacklist'=>$blacklist,

          ));
        }
    }





}
