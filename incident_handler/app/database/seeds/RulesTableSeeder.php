<?php

   class RulesTableSeeder extends Seeder
   {

     public function run()
     {
       Rule::create([

                'sid' => '00001' ,
                'message' =>'conexión rara',
                'rule' => 'alert tcp any any -> 192.168.1.0/24 111',
                'translate' => 'translate',
                'rule_is'=>'es raro que pase',
                'why'=>'por que sí',

                                        ]);
      Rule::create([

               'sid' => '00002' ,
               'message' =>'conexión rara 2',
               'rule' => 'alert tcp any any -> 192.168.1.0/24 444',
               'translate' => 'translate',
               'rule_is'=>'es raro que pase',
               'why'=>'por que sí',

                                       ]);
    }

  }
