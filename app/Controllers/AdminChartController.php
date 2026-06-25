<?php

    namespace App\Controllers;

    use App\Models\CongeModel;
    use App\Models\UserModel;

    class AdminChartController extends BaseController{

        public function CongeMois(){
            $model = new CongeModel();
            $data = $model->getCongeMois();
            $dataJour = $model->getJourConge();

            $label = [];
            $total = [];
            $labelJour = [];
            $totalJour = [];

            foreach($data as $d){
                $label[] = $d['month'];
                $total[] = $d['total'];
            }

            foreach($dataJour as $d){
                $labelJour[] = $d['jourSemaine'];
                $totalJour[] = $d['total'];
            }

            $data['chartLabel'] = json_encode($label);
            $data['chartData'] = json_encode($total);
            $data['chartJourLabel'] = json_encode($labelJour);
            $data['chartJourData'] = json_encode($totalJour);

            return view('/pages/admin/tableau-bord',  $data);
        }

        
    }

?>