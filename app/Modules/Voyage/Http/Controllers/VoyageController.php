<?php

namespace App\Modules\Voyage\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Code\Models\Code;
use App\Modules\Crane\Models\Crane;
use App\Modules\Utilisateur\Models\Action;
use App\Modules\Vessel\Models\Vessel;
use App\Modules\Voyage\Models\CraneVoyage;
use App\Modules\Voyage\Models\OtherDelay;
use App\Modules\Voyage\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;

class VoyageController extends Controller
{
    public function index(){
        $ExistData = array();
        $rs=Voyage::with("crane_voyages")->with("other_delays")->with("vessel")->get();
        for ($i = 0; $i < count($rs); $i++) {
            if(date('y-m-d h:i',strtotime($rs[$i]->vessel->eta))>=date('y-m-d h:i',strtotime("-2 day")) && date('y-m-d h:i',strtotime($rs[$i]->vessel->etd))<=date('y-m-d h:i',strtotime("+2 day"))){
                array_push($ExistData, $rs[$i]);

            }
        }
        return [
            "payload" => $ExistData,
            "status" => "200"
        ];
    }
    public function indexAll(){

        $rs=Voyage::with("crane_voyages")->with("other_delays")->with("vessel")->get();
        return [
            "payload" => $rs,
            "status" => "200"
        ];
    }
    public function get($id){

        $vessel=Voyage::find($id);
        if(!$vessel){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $vessel,
                "status" => "200"
            ];

        }
    }
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            "vawgd" => "boolean",
            "voyage_number" => "string",
            "vawsnrog" => "boolean",
            "dm_y" => "boolean",
            "dm_g" => "boolean",
            "hatch_covers_num" => "integer",
            "hatch_covers_moves" => "integer",
            "gear_boxes_num" => "integer",
            "gear_boxes_moves" => "integer",
            "first_line_datetime" => "date",
            "vessel_all_fast" => "date",
            "gangway_secured" => "date",
            "lashers_onboard" => "date",
            "num_mooring_r_fore" => "integer",
            "num_mooring_r_aft" => "integer",
            "dwuscfb" => "boolean",
            "imo_class" => "boolean",
            "imo_class_ps_onb" => "string",
            "last_lift_from" => "date",
            "last_lift_to" => "date",
            "lf_from" => "date",
            "lf_to" => "date",
            "agent_onboard_from" => "date",
            "agent_onboard_to" => "date",
            "safety_net_gangway_from" => "date",
            "safety_net_gangway_to" => "date",
            "pilot_onboard_from" => "date",
            "pilot_onboard_to" => "date",
            "tugs_arrived_from" => "date",
            "tugs_arrived_to" => "date",
            "unmooring_forward_from" => "date",
            "unmooring_forward_to" => "date",
            "unmooring_aft_from" => "date",
            "unmooring_aft_to" => "date",
            "last_line_from" => "date",
            "last_line_to" => "date",
            "shift"=>"string",
            "vessel"=>"required"
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $vessel=$this->createٍVessel($request->vessel)['payload'];
        $voyage=Voyage::make($request->except("vessel_id"));
        $voyage->vessel_id=$vessel->id;
        $voyage->save();

        foreach ($request->crane_voyages as $crane_voyage){
            $returnedValue=$this->crane_vouyages_validatorAndSaver($crane_voyage,$voyage->id);
            if($returnedValue['IsReturnErrorRespone']){
                return [
                    "payload" => $returnedValue['payload'],
                    "status" => $returnedValue['status']
                ];
            }
        }
        foreach ($request->other_delays as $other_delay){
            $returnedValue=$this->other_delays_validatorAndSaver($other_delay,$voyage->id);
            if($returnedValue['IsReturnErrorRespone']){
                return [
                    "payload" => $returnedValue['payload'],
                    "status" => $returnedValue['status']
                ];
            }
        }
        $voyage->crane_voyages=$voyage->craneVoyages;
        $voyage->other_delays=$voyage->otherDelays;
        $voyage->vessel=$vessel;
        $action=new Action;
        $action->vessel_id=$vessel->id;
        $action->utilisateur_id=auth()->user()->id;
        $action->shift=$request->shift;
        $action->actionType="create";
        $action->save();
        return [
            "payload" => $voyage,
            "status" => "200_2"
        ];
    }
    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            "id" => "required",
            "vawgd" => "boolean",
            "voyage_number" => "boolean",
            "vawsnrog" => "boolean",
            "dm_y" => "boolean",
            "dm_g" => "boolean",
            "hatch_covers_num" => "integer",
            "hatch_covers_moves" => "integer",
            "gear_boxes_num" => "integer",
            "gear_boxes_moves" => "integer",
            "first_line_datetime" => "date",
            "vessel_all_fast" => "date",
            "gangway_secured" => "date",
            "lashers_onboard" => "date",
            "num_mooring_r_fore" => "integer",
            "num_mooring_r_aft" => "integer",
            "dwuscfb" => "boolean",
            "imo_class" => "boolean",
            "imo_class_ps_onb" => "string",
            "last_lift_from" => "date",
            "last_lift_to" => "date",
            "lf_from" => "date",
            "lf_to" => "date",
            "agent_onboard_from" => "date",
            "agent_onboard_to" => "date",
            "safety_net_gangway_from" => "date",
            "safety_net_gangway_to" => "date",
            "pilot_onboard_from" => "date",
            "pilot_onboard_to" => "date",
            "tugs_arrived_from" => "date",
            "tugs_arrived_to" => "date",
            "unmooring_forward_from" => "date",
            "unmooring_forward_to" => "date",
            "unmooring_aft_from" => "date",
            "unmooring_aft_to" => "date",
            "last_line_from" => "date",
            "last_line_to" => "date",
            "shif"=>"string"


        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $voyage=Voyage::find($request->id);
        if (!$voyage) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }
        $vessel=Vessel::find($request->vessel["id"]);
        if (!$vessel) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }

        $voyage->vawgd=$request->vawgd;
        $voyage->vawsnrog=$request->vawsnrog;
        $voyage->voyage_number=$request->voyage_number;
        $voyage->dm_y=$request->dm_y;
        $voyage->dm_g=$request->dm_g;
        $voyage->hatch_covers_num=$request->hatch_covers_num;
        $voyage->hatch_covers_moves=$request->hatch_covers_moves;
        $voyage->gear_boxes_num=$request->gear_boxes_num;
        $voyage->gear_boxes_moves=$request->gear_boxes_moves;
        $voyage->first_line_datetime=$request->first_line_datetime;
        $voyage->vessel_all_fast=$request->vessel_all_fast;
        $voyage->gangway_secured=$request->gangway_secured;
        $voyage->lashers_onboard=$request->lashers_onboard;
        $voyage->num_mooring_r_fore=$request->num_mooring_r_fore;
        $voyage->num_mooring_r_aft=$request->num_mooring_r_aft;
        $voyage->dwuscfb=$request->dwuscfb;
        $voyage->imo_class=$request->imo_class;
        $voyage->imo_class_ps_onb=$request->imo_class_ps_onb;
        $voyage->last_lift_from=$request->last_lift_from;
        $voyage->last_lift_to=$request->last_lift_to;
        $voyage->lf_from=$request->lf_from;
        $voyage->lf_to=$request->lf_to;
        $voyage->agent_onboard_from=$request->agent_onboard_from;
        $voyage->agent_onboard_to=$request->agent_onboard_to;
        $voyage->safety_net_gangway_from=$request->safety_net_gangway_from;
        $voyage->safety_net_gangway_to=$request->safety_net_gangway_to;
        $voyage->pilot_onboard_from=$request->pilot_onboard_from;
        $voyage->pilot_onboard_to=$request->pilot_onboard_to;
        $voyage->tugs_arrived_from=$request->tugs_arrived_from;
        $voyage->tugs_arrived_to=$request->tugs_arrived_to;
        $voyage->unmooring_forward_from=$request->unmooring_forward_from;
        $voyage->unmooring_forward_to=$request->unmooring_forward_to;
        $voyage->unmooring_aft_from=$request->unmooring_aft_from;
        $voyage->unmooring_aft_to=$request->unmooring_aft_to;
        $voyage->last_line_from=$request->last_line_from;
        $voyage->last_line_to=$request->last_line_to;
        $voyage->save();
        foreach ($request->crane_voyages as $crane_voyage){
            $returnedValue=$this->crane_vouyages_validatorAndUpdater($crane_voyage);
            if($returnedValue['IsReturnErrorRespone']){
                return [
                    "payload" => $returnedValue['payload'],
                    "status" => $returnedValue['status']
                ];
            }
        }
        foreach ($request->other_delays as $other_delay){
            $returnedValue=$this->other_delays_validatorAndUpdater($other_delay);
            if($returnedValue['IsReturnErrorRespone']){
                return [
                    "payload" => $returnedValue['payload'],
                    "status" => $returnedValue['status']
                ];
            }
        }
        $_vesselReturned=$this->updateٍVessel($request->vessel);
        if($_vesselReturned['IsReturnErrorRespone'])
            return [
                "payload" => $_vesselReturned['payload'],
                "status" => $_vesselReturned['status']
            ];
        $voyage->vessel=$_vesselReturned['payload'];
        $voyage->crane_voyages=$voyage->craneVoyages;
        $voyage->other_delays=$voyage->otherDelays;
        $action=new Action;
        $action->vessel_id=$vessel->id;
        $action->utilisateur_id=auth()->user()->id;
        $action->shift=$request->shift;
        $action->actionType="update";
        $action->save();
        return [
            "payload" => $voyage,
            "status" => "200_3"
        ];
    }
    public function delete(Request $request){

        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2_delete"
            ];
        }
        $vessel=Vessel::find($request->id);
        if(!$vessel){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $vessel->delete();

            return [
                "payload" => "Deleted successfully",
                "status" => "200"
            ];
        }
    }
    public function crane_vouyages_validatorAndSaver($crane_voyage,$voyage_id){
        $validator = Validator::make($crane_voyage, [
            "crane_id" => "required|integer",
        ]);
        if ($validator->fails()) {

            return [
                "payload" => $validator->errors(),
                "status" => "406_2_crane",
                "IsReturnErrorRespone" => true
            ];
        }
        $voyage=Voyage::find($voyage_id);
        if(!$voyage){
            return [
                "payload"=>"voyage is not exist !",
                "status"=>"404_2",
                "IsReturnErrorRespone" => true
            ];
        }
        $crane=Crane::find($crane_voyage['crane_id']);
        if(!$crane){
            return [
                "payload"=>"Crane is not exist !",
                "status"=>"404_2",
                "IsReturnErrorRespone" => true
            ];
        }
        $v_crane=CraneVoyage::make($crane_voyage);
        $v_crane->voyage_id=$voyage_id;
        $v_crane->save();
        return [
            "payload" => $v_crane,
            "status" => "200_2",
            "IsReturnErrorRespone" => false
        ];
    }
    public function other_delays_validatorAndSaver($other_delay,$voyage_id){
        $validator = Validator::make($other_delay, [
            "crane_id" => "required|integer",

        ]);
        if ($validator->fails()) {

            return [
                "payload" => $validator->errors(),
                "status" => "406_2_other_delays",
                "IsReturnErrorRespone" => true
            ];
        }
        $voyage=Voyage::find($voyage_id);
        if(!$voyage){
            return [
                "payload"=>"voyage is not exist !",
                "status"=>"404_2",
                "IsReturnErrorRespone" => true
            ];
        }
        $code=Code::find($other_delay['code_id']);
        if(!$code){
            return [
                "payload"=>"code is not exist !",
                "status"=>"404_5",
                "IsReturnErrorRespone" => true
            ];
        }
        $crane=Crane::find($other_delay['crane_id']);
        if(!$crane){
            return [
                "payload"=>"Crane is not exist !",
                "status"=>"404_2",
                "IsReturnErrorRespone" => true
            ];
        }
        $o_delay=OtherDelay::make($other_delay);
        $o_delay->voyage_id=$voyage_id;
        $o_delay->code_id=$other_delay['code_id'];
        $o_delay->save();
        $o_delay->code=$code;
        return [
            "payload" => $o_delay,
            "status" => "200_2",
            "IsReturnErrorRespone" => false
        ];
    }
    public function crane_vouyages_validatorAndUpdater($crane_voyage){
        $validator = Validator::make($crane_voyage, [
            "id" => "required",
            "voyage_id" => "required",
            "crane_id" => "required|integer",


        ]);
        if ($validator->fails()) {

            return [
                "payload" => $validator->errors(),
                "status" => "crane_vouyages_406_2_crane_voyage",
                "IsReturnErrorRespone" => true
            ];
        }
        $voyage=Voyage::find($crane_voyage['voyage_id']);
        if(!$voyage){
            return [
                "payload"=>"voyage is not exist !",
                "status"=>"crane_vouyages_404_2",
                "IsReturnErrorRespone" => true
            ];
        }
        $crane=Crane::find($crane_voyage['crane_id']);
        if(!$crane){
            return [
                "payload"=>"Crane is not exist !",
                "status"=>"crane_vouyages_404_2",
                "IsReturnErrorRespone" => true
            ];
        }
        $v_crane=CraneVoyage::find($crane_voyage['id']);
        if (!$v_crane) {
            return [
                "payload"=>"CraneVoyage is not exist !",
                "status"=>"crane_vouyages_404_2",
                "IsReturnErrorRespone" => true
            ];
        }
        $v_crane->crane_id=$crane_voyage['crane_id'];
        $v_crane->voyage_id=$crane_voyage['voyage_id'];
        $v_crane->cbd=$crane_voyage['cbd'];
        $v_crane->dgbohc_bfl_from=$crane_voyage['dgbohc_bfl_from'];
        $v_crane->dgbohc_bfl_to=$crane_voyage['dgbohc_bfl_to'];
        $v_crane->dgbohc_bfl_num_gb=$crane_voyage['dgbohc_bfl_num_gb'];
        $v_crane->dgbohc_bfl_num_hc=$crane_voyage['dgbohc_bfl_num_hc'];
        $v_crane->dss_bfl_from=$crane_voyage['dss_bfl_from'];
        $v_crane->dss_bfl_to=$crane_voyage['dss_bfl_to'];
        $v_crane->dss_bfl_num_sp=$crane_voyage['dss_bfl_num_sp'];
        $v_crane->dss_bfl_fb_dnw=$crane_voyage['dss_bfl_fb_dnw'];
        $v_crane->dss_bfl_fb=$crane_voyage['dss_bfl_fb'];
        $v_crane->ffl=$crane_voyage['ffl'];
        $v_crane->fll=$crane_voyage['fll'];
        $v_crane->sfl=$crane_voyage['sfl'];
        $v_crane->sll=$crane_voyage['sll'];
        $v_crane->tfl=$crane_voyage['tfl'];
        $v_crane->tll=$crane_voyage['tll'];
        $v_crane->lgbohc_all_from=$crane_voyage['lgbohc_all_from'];
        $v_crane->lgbohc_all_to=$crane_voyage['lgbohc_all_to'];
        $v_crane->lgbohc_all_num_gb=$crane_voyage['lgbohc_all_num_gb'];
        $v_crane->lgbohc_all_hc=$crane_voyage['lgbohc_all_hc'];
        $v_crane->lgbohc_all_inbay=$crane_voyage['lgbohc_all_inbay'];

        $v_crane->lss_all_from=$crane_voyage['lss_all_from'];
        $v_crane->lss_all_to=$crane_voyage['lss_all_to'];
        $v_crane->lss_all_num_ss=$crane_voyage['lss_all_num_ss'];
        $v_crane->lss_all_ib_lnw=$crane_voyage['lss_all_ib_lnw'];
        $v_crane->cbu=$crane_voyage['cbu'];
        $v_crane->save();
        return [
            "payload" => $v_crane,
            "status" => "crane_vouyages_200_2",
            "IsReturnErrorRespone" => false
        ];
    }
    public function other_delays_validatorAndUpdater($other_delay){
        $validator = Validator::make($other_delay, [
            "id" => "required",
            "crane_id" => "required|integer",
            "voyage_id" => "required|integer",



        ]);
        if ($validator->fails()) {

            return [
                "payload" => $validator->errors(),
                "status" => "406_2_other_delays",
                "IsReturnErrorRespone" => true
            ];
        }
        $voyage=Voyage::find($other_delay['voyage_id']);
        if(!$voyage){
            return [
                "payload"=>"voyage is not exist !",
                "status"=>"other_delays_404_2",
                "IsReturnErrorRespone" => true
            ];
        }
        $code=Code::find($other_delay['code_id']);
        if(!$code){
            return [
                "payload"=>"code is not exist !",
                "status"=>"other_delays_404_2",
                "IsReturnErrorRespone" => true
            ];
        }
        $crane=Crane::find($other_delay['crane_id']);
        if(!$crane){
            return [
                "payload"=>"Crane is not exist !",
                "status"=>"other_delays_404_2",
                "IsReturnErrorRespone" => true
            ];
        }
        $o_delay=OtherDelay::find($other_delay['id']);
        if (!$o_delay) {
            return [
                "payload"=>"OtherDelay is not exist !",
                "status"=>"other_delays_404_2",
                "IsReturnErrorRespone" => true
            ];
        }
        $o_delay->crane_id=$other_delay['crane_id'];
        $o_delay->voyage_id=$other_delay['voyage_id'];
        $o_delay->code_id=$other_delay['code_id'];
        $o_delay->from=$other_delay['from'];
        $o_delay->to=$other_delay['to'];
        $o_delay->reason=$other_delay['reason'];
        $o_delay->comment=$other_delay['comment'];
        $o_delay->code=$other_delay['code'];
        $o_delay->category=$other_delay['category'];
        $o_delay->dep_arr=$other_delay['dep_arr'];

        $o_delay->save();
        $o_delay->code=$code;
        return [
            "payload" => $o_delay,
            "status" => "other_delays_200_2",
            "IsReturnErrorRespone" => false
        ];
    }
    public function CraneVoyageDelete(Request $request){

        $craneVoyage=CraneVoyage::find($request->id);
        if(!$craneVoyage){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $craneVoyage->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }
    public function allVoyages($date){
        $notExistData = array();
        try {
            $store = DB::connection('oracle');
            $data = $store->select("select t.voy_system_key as voy_no,t.ves_name as vessel_name,t.service_name as service,t.voy_eta_ts as eta,t.voy_etd_ts as etd from VOYAGE_M t where trunc(t.voy_eta_ts)=trunc(TO_DATE('".$date."', 'DD-MM-YYYY'))");
            $vessels=Vessel::whereDate('eta', '>=', $date)->select('voy_no')->get();
            $vessels=@json_decode(json_encode($vessels), true);
            for ($i = 0; $i < count($vessels); $i++) {
                $vessels[$i]=$vessels[$i]["voy_no"];
            }
            for ($i = 0; $i < count($data); $i++) {
                if(!in_array($data[$i]->voy_no, $vessels))
                    array_push($notExistData, $data[$i]);
            }
            return $notExistData;






        }catch (Exception $e){
            $this->allVoyages($date);
        }
    }
    public function createٍVessel($vessel){

        $validator = Validator::make($vessel, [
            "voy_no" => "required|string",
            "vessel_name" => "required|string",
            "service" => "required|string",

        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2",
                "IsReturnErrorRespone" => true
            ];
        }
        $_vessel=Vessel::make($vessel);
        $_vessel->save();
        return [
            "payload" => $_vessel,
            "status" => "200_2",
            "IsReturnErrorRespone" => false
        ];;
    }
    public function updateٍVessel($vessel){

        $validator = Validator::make($vessel, [
            "id" => "required",
            "voy_no" => "string|required",
            "vessel_name" => "required|string",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2",
                "IsReturnErrorRespone" => true
            ];


        }
        $_vessel=Vessel::find($vessel["id"]);
        if (!$vessel) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_2",
                "IsReturnErrorRespone" => true
            ];
        }
        $_vessel->voy_no=$vessel["voy_no"];
        $_vessel->vessel_name=$vessel["vessel_name"];
        $_vessel->service=$vessel["service"];
        $_vessel->eta=$vessel["eta"];
        $_vessel->etd=$vessel["etd"];
        $_vessel->save();
        return [
            "payload" => $_vessel,
            "status" => "200",
            "IsReturnErrorRespone" => false
        ];
    }
    public function saveOrUpdateVoyage(Request $request){
        if($request->id==""){
            $validator = Validator::make($request->all(), [
                "vessel"=>"required"
            ]);
            if ($validator->fails()) {
                return [
                    "payload" => $validator->errors(),
                    "status" => "vessel_empty_406_2_voyage"
                ];
            }
            $returnedValue=$this->createٍVessel($request->vessel);
            if($returnedValue['IsReturnErrorRespone']){
                return [
                    "payload" => $returnedValue['payload'],
                    "status" => $returnedValue['status']
                ];
            }
            $vessel=$returnedValue["payload"];
            $voyage=Voyage::make($request->except("vessel_id"));
            $voyage->vessel_id=$vessel["id"];
            $voyage->save();
            foreach ($request->crane_voyages as $crane_voyage){
                if($crane_voyage["id"]==""){
                    $returnedValue=$this->crane_vouyages_validatorAndSaver($crane_voyage,$voyage->id);
                    if($returnedValue['IsReturnErrorRespone']){
                        return [
                            "payload" => $returnedValue['payload'],
                            "status" => $returnedValue['status']
                        ];
                    }
                }
                else{
                    $returnedValue=$this->crane_vouyages_validatorAndUpdater($crane_voyage);
                    if($returnedValue['IsReturnErrorRespone']){
                        return [
                            "payload" => $returnedValue['payload'],
                            "status" => $returnedValue['status']
                        ];
                    }
                }
            }
            foreach ($request->other_delays as $other_delay){
               if($other_delay["id"]==""){
                   $returnedValue=$this->other_delays_validatorAndSaver($other_delay,$voyage->id);
                   if($returnedValue['IsReturnErrorRespone']){
                       return [
                           "payload" => $returnedValue['payload'],
                           "status" => $returnedValue['status']
                       ];
                   }
               }
               else{
                   $returnedValue=$this->other_delays_validatorAndUpdater($other_delay);
                   if($returnedValue['IsReturnErrorRespone']){
                       return [
                           "payload" => $returnedValue['payload'],
                           "status" => $returnedValue['status']
                       ];
                   }
               }
            }
            $voyage->crane_voyages=$voyage->craneVoyages;
            $voyage->other_delays=$voyage->otherDelays;
            $voyage->vessel=$vessel;
            $action=new Action;
            $action->vessel_id=$vessel->id;
            $action->utilisateur_id=auth()->user()->id;
            $action->shift=$request->shift;
            $action->actionType="create";
            $action->save();
            return [
                "payload" => $voyage,
                "status" => "200"
            ];

        }
        else {
            $validator = Validator::make($request->all(), [
                "id" => "required",
            ]);
            if ($validator->fails()) {
                return [
                    "payload" => $validator->errors(),
                    "status" => "406_2_voyage"
                ];
            }
            $voyage=Voyage::find($request->id);
            if (!$voyage) {
                return [
                    "payload" => "The searched row does not exist !",
                    "status" => "404_3"
                ];
            }
            $vessel=Vessel::find($request->vessel["id"]);
            if (!$vessel) {
                return [
                    "payload" => "The searched row does not exist !",
                    "status" => "404_3"
                ];
            }
            $_vesselReturned=$this->updateٍVessel($request->vessel);
            if($_vesselReturned['IsReturnErrorRespone'])
                return [
                    "payload" => $_vesselReturned['payload'],
                    "status" => $_vesselReturned['status']
                ];
            $voyage->vawgd=$request->vawgd;
            $voyage->vawsnrog=$request->vawsnrog;
            $voyage->voyage_number=$request->voyage_number;
            $voyage->dm_y=$request->dm_y;
            $voyage->dm_g=$request->dm_g;
            $voyage->hatch_covers_num=$request->hatch_covers_num;
            $voyage->hatch_covers_moves=$request->hatch_covers_moves;
            $voyage->gear_boxes_num=$request->gear_boxes_num;
            $voyage->gear_boxes_moves=$request->gear_boxes_moves;
            $voyage->first_line_datetime=$request->first_line_datetime;
            $voyage->vessel_all_fast=$request->vessel_all_fast;
            $voyage->gangway_secured=$request->gangway_secured;
            $voyage->lashers_onboard=$request->lashers_onboard;
            $voyage->num_mooring_r_fore=$request->num_mooring_r_fore;
            $voyage->num_mooring_r_aft=$request->num_mooring_r_aft;
            $voyage->dwuscfb=$request->dwuscfb;
            $voyage->imo_class=$request->imo_class;
            $voyage->imo_class_ps_onb=$request->imo_class_ps_onb;
            $voyage->last_lift_from=$request->last_lift_from;
            $voyage->last_lift_to=$request->last_lift_to;
            $voyage->last_lift_comment=$request->last_lift_comment;
            $voyage->lf_from=$request->lf_from;
            $voyage->lf_to=$request->lf_to;
            $voyage->lf_comment=$request->lf_comment;
            $voyage->agent_onboard_from=$request->agent_onboard_from;
            $voyage->agent_onboard_to=$request->agent_onboard_to;
            $voyage->agent_onboard_comment=$request->agent_onboard_comment;
            $voyage->safety_net_gangway_from=$request->safety_net_gangway_from;
            $voyage->safety_net_gangway_to=$request->safety_net_gangway_to;
            $voyage->safety_net_gangway_comment=$request->safety_net_gangway_comment;
            $voyage->pilot_onboard_from=$request->pilot_onboard_from;
            $voyage->pilot_onboard_to=$request->pilot_onboard_to;
            $voyage->pilot_onboard_comment=$request->pilot_onboard_comment;
            $voyage->tugs_arrived_from=$request->tugs_arrived_from;
            $voyage->tugs_arrived_to=$request->tugs_arrived_to;
            $voyage->tugs_arrived_comment=$request->tugs_arrived_comment;
            $voyage->unmooring_forward_from=$request->unmooring_forward_from;
            $voyage->unmooring_forward_to=$request->unmooring_forward_to;
            $voyage->unmooring_forward_comment=$request->unmooring_forward_comment;
            $voyage->unmooring_aft_from=$request->unmooring_aft_from;
            $voyage->unmooring_aft_to=$request->unmooring_aft_to;
            $voyage->unmooring_aft_comment=$request->unmooring_aft_comment;
            $voyage->last_line_from=$request->last_line_from;
            $voyage->last_line_to=$request->last_line_to;
            $voyage->last_line_comment=$request->last_line_comment;
            $voyage->pgb_r_co=$request->pgb_r_co;
            $voyage->pgb_r_co_reason=$request->pgb_r_co_reason;
            $voyage->save();
            foreach ($request->crane_voyages as $crane_voyage){
                if($crane_voyage["id"]==""){
                    $returnedValue=$this->crane_vouyages_validatorAndSaver($crane_voyage,$voyage->id);
                    if($returnedValue['IsReturnErrorRespone']){
                        return [
                            "payload" => $returnedValue['payload'],
                            "status" => $returnedValue['status']
                        ];
                    }
                }
                else{
                    $returnedValue=$this->crane_vouyages_validatorAndUpdater($crane_voyage);
                    if($returnedValue['IsReturnErrorRespone']){
                        return [
                            "payload" => $returnedValue['payload'],
                            "status" => $returnedValue['status']
                        ];
                    }
                }
            }

            foreach ($request->other_delays as $other_delay){
                if($other_delay["id"]==""){
                    $returnedValue=$this->other_delays_validatorAndSaver($other_delay,$voyage->id);
                    if($returnedValue['IsReturnErrorRespone']){
                        return [
                            "payload" => $returnedValue['payload'],
                            "status" => $returnedValue['status']
                        ];
                    }
                }
                else{
                    $returnedValue=$this->other_delays_validatorAndUpdater($other_delay);
                    if($returnedValue['IsReturnErrorRespone']){
                        return [
                            "payload" => $returnedValue['payload'],
                            "status" => $returnedValue['status']
                        ];
                    }
                }
            }
            $voyage->vessel=$_vesselReturned['payload'];
            $voyage->crane_voyages=$voyage->craneVoyages;
            $voyage->other_delays=$voyage->otherDelays;
            $action=new Action;
            $action->vessel_id=$vessel->id;
            $action->utilisateur_id=auth()->user()->id;
            $action->shift=$request->shift;
            $action->actionType="update";
            $action->save();
            return [
                "payload" => $voyage,
                "status" => "200"
            ];


        }

    }
    public function deleteOtherDelay(Request $request){

        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2_other_delays"
            ];
        }
        $otherDelay=OtherDelay::find($request->id);
        if(!$otherDelay){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $otherDelay->delete();

            return [
                "payload" => "Deleted successfully",
                "status" => "200"
            ];
        }
    }
    public function getActionHistory($vessel_id){

        $vessel=Vessel::find($vessel_id);
        if(!$vessel){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $vessel->actions(),
                "status" => "200"
            ];

        }
    }
}

