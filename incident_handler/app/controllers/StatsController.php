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
                                            group by month"));
          }else if ($option==2) {
            
            $incidents=DB::select(DB::raw(" select count(*), extract(day from t.datetime) as day, extract(month from t.datetime) as month
                                            from incidents as i, time as t
                                            where i.id=t.incidents_id and
                                            t.time_types_id=1
                                            and t.datetime between '".$start."' and '".$end."'
                                            group by day,month"));
          }
          return $this->layout = View::make("stats._incident", array(
            'incidents'=>$incidents,
            'option'=>$option,

          ));
        }
        //select count(*), extract(month from t.datetime) as month from incidents as i, time as t where i.id=t.incidents_id and t.time_types_id=1 group by month;



    }



  /**
   * Setup the layout used by the controller.
   *
   * @return void
   */

}
