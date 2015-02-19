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
          $set_blacklist="";
          if ($src_dst==1) {
            $join_occurrence="io.source_id";
          }else if ($src_dst==2) {
            $join_occurrence="io.destiny_id";
          }
          if ($blacklist==1) {
            $set_blacklist="FALSE";
          }else if ($blacklist==2) {
            $set_blacklist="TRUE";
          }

          $incidents=DB::select(DB::raw("select
                                          o.ip as ip,
                                          count(o.id)
                                        from
                                          occurrences as o,
                                          occurences_history as oh
                                        where
                                          o.id=oh.occurences_id
                                        and
                                          o.ip not like ''
                                        and
                                          o.blacklist=".$set_blacklist."

                                        and
                                          o.id=(
                                            select ".$join_occurence." from
                                              incidents_occurences as io,
                                              incidents as i,
                                              customers as c
                                            where
                                              io.source_id=o.id
                                            and
                                              io.incidents_id=i.id
                                            and
                                              c.customers_id=".$customer."
                                            and
                                              i.customers_id=c.id limit 1)
                                        group by
                                          ip
                                        order by
                                          count desc
                                        limit ".$top."
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
