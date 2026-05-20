<?php

    namespace App\Controllers;

    use App\Models\CongeModel;
    use App\Models\UserModel;

    class AdminChartController extends BaseController{

        public function CongeMois(){
            $model = new CongeModel();
            $data = $model->getCongeMois();

            $label = [];
            $total = [];

            foreach($data as $d){
                $label = $d['month'];
                $total = $d['total'];
            }

            $data['chartLabel'] = json_encode($label);
            $data['chartData'] = json_encode($total);

            return view('/admin/tableau-bord', ['data' => $data]);
        }
    }

?>