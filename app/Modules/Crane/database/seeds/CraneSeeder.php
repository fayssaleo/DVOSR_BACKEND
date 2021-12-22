<?php

namespace App\Modules\Crane\Database\Seeds;

use App\Modules\Code\Models\Code;
use App\Modules\Crane\Models\Crane;
use Illuminate\Database\Seeder;

class CraneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crane = new Crane;
        $crane->craneId="STS1";
        $crane->save();
        //---------------------
        $crane = new Crane;
        $crane->craneId="STS2";
        $crane->save();
        //---------------------
        $crane = new Crane;
        $crane->craneId="STS3";
        $crane->save();
        //---------------------
        $crane = new Crane;
        $crane->craneId="STS4";
        $crane->save();
        //---------------------
        $crane = new Crane;
        $crane->craneId="STS5";
        $crane->save();
        //---------------------
        $crane = new Crane;
        $crane->craneId="STS6";
        $crane->save();
        //---------------------
        $crane = new Crane;
        $crane->craneId="STS7";
        $crane->save();
        //---------------------
        $crane = new Crane;
        $crane->craneId="STS8";
        $crane->save();
        //---------------------

        $code=new Code;
        $code->code="1-Crane fault";
        $code->description="All the issues related to the QC body or functionnalities (Hoist, Trolley, gantry, Elevator, Boom, ..)";
        $code->category="Technical";
        $code->save();
        //---------------------

        $code=new Code;
        $code->code="2-Spreader fault";
        $code->description="All issues related to spreader or it functionnalities (Flipper, Oil leakage, TLS, twin detection, Twistlock, ..)";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="3-Spreader change";
        $code->description="Time to change the spreader. This delay should come after 'Spreader fault' delay as a solution";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="4-Projectors fault";
        $code->description="Projectors of the crane are off or not functionning well";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="5-CHE cleaning";
        $code->description="TT, RTG, RS and QC cleaning due to oil, dirt, smell, smoke, ..";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="6-CHE impacting other";
        $code->description="QC impacting the movement of another crane. QC not able to enter to a bay or to move because of another BD crane.";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="7-RTG/RS BD";
        $code->description="RTG or RS broken-down and impacting QC production.";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="8-TT BD";
        $code->description="TT Broken-down impacting the QC productivity";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="9-OHF BD";
        $code->description="Over high frame broken down impacting QC productivity. Yard and vessel)";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="12-QC clash";
        $code->description="2 cranes or more clashing and not able to work because the distance between the bays is not enough.";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="28-Twistlock opening";
        $code->description="QC stopped waiting for twistlock opening";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="30-Accident / incident";
        $code->description="Accident or incident impacting the QC productivity";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="32-Malfunctionning reefer in the yard";
        $code->description="Reefer plugged but malfunction and generating delay on the QC.";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="33-system failure";
        $code->description="TOS failure impacting operations/QC";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="34-Outsourcing company delay (To specify)";
        $code->description="Delay related to outsourced company (Delay to be given by Foreman or SM only)";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="35-Removing/adding IMO labels";
        $code->description="Adding or removing IMO label upon the need of the vessel/line";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="36-Other ops delays";
        $code->description="Exceptionnal delays (with the approval of the SM only)";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="60-Unscheduled Power failure";
        $code->description="Power cut stopping QCs";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="61-Scheduled power cut";
        $code->description="Power cut planned to have and customer already informed (with the approval of the SM only)";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="62-Scheduled system off";
        $code->description="Planned system off (with the approval of the SM only)";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="65-Fog stopping operations";
        $code->description="Dense fog stopping the QC productivity";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="66-Wind stopping cranes";
        $code->description="High wind stopping cranes";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="67-Rain/snow stopping operations";
        $code->description="Heavy rain/snow stopping operations";
        $code->category="Technical";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="10-Other tec delays";
        $code->description="Exceptionnal delays (Only with the approval of the technical engineer in shift)";
        $code->category="Technical";
        $code->save();
        //---------------------








        $code=new Code;
        $code->code="12-QC clash";
        $code->description="2 cranes or more clashing and not able to work because the distance between the bays is not enough.";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="13-QC boom up/ boom down";
        $code->description="Qc boom up/down to height (Bridge, cheminee, high bay, ..)";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="14-QC shifting";
        $code->description="Shifting of more than 1 crane at the same time.";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="15-Twins from/to different block";
        $code->description="Discharge: Twin containers to be discharged in different bays / blocks  Load: Twin containers to be loaded from different bays/blocks in the yard";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="16-Waiting reefer unplug in the yard";
        $code->description="QC stopped due to reefers not unplugged in the yard.";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="17-RTG gantry";
        $code->description="RTG not in position and impacting the QC productivity";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="18-1 RTG serving 1 crane";
        $code->description="Load not alternated because of cargo consolidated and should work with only 1 RTG / RS vs 1 QC";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="19-RTG clash";
        $code->description="2 QCs or more working from the same location in the yard at the same time and having impact on the QC productivity.";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="20-Rehandles";
        $code->description="Yard re-handles impacting directly the QC productivity";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="21-Gerbox";
        $code->description="Yard tower that the RTG crosses to load or discharge a container and have an impact on the QC productivity";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="22-Gaerbox";
        $code->description="Yard congestion in yard impacting the QC feeding and thus productivity";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="23-Missing container in the yard";
        $code->description="Container not found at the declared position and impacting the QC productivity";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="24-Rumbled container in the yard";
        $code->description="Container not found at the declared position but found under or in another position inside the same bay generating delay for the QC.";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="25-Special handling in the yard";
        $code->description="Preparing OOG, Damage container in the yard and impacting QC productivity";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="26-twins not aligned on truck";
        $code->description="Twins not put correclty onto the truck impacting the QC productivity";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="27-Lashing/unlashing";
        $code->description="QC stopped waiting for lashing and unlashing";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="28-Twistlock opening";
        $code->description="QC stopped waiting for twistlock opening";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="29-Human mistake";
        $code->description="A mistake related to a collaborator (Delay to given by the SM and foreman only)";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="30-Accident / incident";
        $code->description="Accident or incident impacting the QC productivity";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="31-Changeover";
        $code->description="Stoppage for handover of the operators. Yard and Vessel";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="32-Malfunctionning reefer in the yard";
        $code->description="Reefer plugged but malfunction and generating delay on the QC.";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="33-system failure";
        $code->description="TOS failure impacting operations/QC";
        $code->category="Operational";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="34-Outsourcing company delay (To specify)";
        $code->description="Delay related to outsourced company (Delay to be given by Foreman or SM only)";
        $code->category="Operational";
        $code->save();
        //---------------------

        $code=new Code;
        $code->code="36-Other ops delays";
        $code->description="Exceptionnal delays (with the approval of the SM only)";
        $code->category="Operational";
        $code->save();
        //---------------------







        $code=new Code;
        $code->code="37-Missing twistlock";
        $code->description="Insufficient twistlock impacting the QC productivity";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="38-Twistlock removal (Hold only)";
        $code->description="Twistlock put instead of stacker impacting the QC productivity";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="39-insufficient lashing material";
        $code->description="Insufficient lashing bars, bins, ..";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="40-Shifting lashing material";
        $code->description="Housekeeping of the lashing materials impacting the QC productivity";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="41-Lashing system issue";
        $code->description="Lashing system to be rectified due to a wrong communication from the vessel";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="42-Waiting for load approval";
        $code->description="Load approval is not approved due a vessel issue (System, CO not checking, ..)";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="43-Vessel/line change stopping operations";
        $code->description="Urgent change which impacted the current plan generating a stoppage";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="44-Wrong instruction from vessel";
        $code->description="receipt of wrong instruction from the vessel (Reefer motor facing, ..)";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="45-Wrong vessel profile";
        $code->description="Vessel structure not matching with the vessel profile received from the line";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="46-Waiting reefer unplug (Vessel)";
        $code->description="Waiting for the unplug of reefers from the vessel side";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="47-Vessel rumbled (Discharge and Load)";
        $code->description="Containers to be discharged not found in the declared position. Containers bay drawing not matching with the instruction";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="48-Special handling (Damage, BB)";
        $code->description="Loading or discharging of damaged containers or uncontainerized cargo.";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="49-Hydraulic hatch cover";
        $code->description="";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="50-Special handling of damaged hatch cover";
        $code->description="Handling of damaged hatch covers or gear boxes";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="51-Vessel damaged stopping operations";
        $code->description="Vessel damage that leads to a stoppage of the QC";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="52-Damaged/missing cell guide";
        $code->description="Damaged or missing cell guide impacting the QC productivity";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="53-Malfunctionning reefer onboard";
        $code->description="Mafunctionning reefer onboard generating extra moves and extra delays.";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="54-Overweight containers (Delay after weighing)";
        $code->description="Undeclared overweight containers impacting the QC productivity (With the SM approval only)";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="55-Twins not aligned onboard (Discharge only)";
        $code->description="Twins not aligned onboard and cannot be discharged as twin";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="56-Shifting ship crane/gear";
        $code->description="Waiting for the vessel to turn/move its ship crane";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="57-Operations stoppage due to unsafety onboard";
        $code->description="Lashing/unlashing stopped due to unsafe cat walk, unsafe ropes, .. (with the approval of the FRM and/or SM)";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="58-Unsafe vessel condition impacting operations";
        $code->description="Unsafe vessel condition impacting QC productivity (Vessel stability, ..)  (with the approval of the FRM and/or SM)";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="59-Vessel crew stopping operations";
        $code->description="Crew requesting to stop operations for unspecified reason (With SM approval only)";
        $code->category="Deductible";
        $code->save();
        //---------------------



        $code=new Code;
        $code->code="63-Vessel shifting (Hatch cover impact)";
        $code->description="Vessel shifting due to swell, wind and generating a gantry with hatch cover";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="64-Draft issue";
        $code->description="Vessel not matching the required draught and generating an impact on the QC productivity";
        $code->category="Deductible";
        $code->save();
        //---------------------


        $code=new Code;
        $code->code="68-Cargo roll-overed";
        $code->description="Roll-overed containers impacting the QC productivity (with the approval of the SM only)";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="69-Cargo not customs cleared";
        $code->description="Cargo not customs cleared impacting the QC productivity (with the approval of the SM only)";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="70-POD or weight class change";
        $code->description="Change of POD or weight class impacting the QC productivity (with the approval of the SM only)";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="71-Cargo condition";
        $code->description="Cargo not well split, lashed or arranged inside the containers impacting the QC productivity  (with the approval of the SM only)";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="73-Jammed twistlock";
        $code->description="Twistlock stucked, rusted, dirty, .. ";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="28-Twistlock opening";
        $code->description="QC stopped waiting for twistlock opening";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="30-Accident / incident";
        $code->description="Accident or incident impacting the QC productivity";
        $code->category="Deductible";
        $code->save();
        //---------------------
        $code=new Code;
        $code->code="73-Other deductible delays";
        $code->description="Exceptionnal delays (with the approval of the SM only)";
        $code->category="Deductible";
        $code->save();
        //---------------------

    }
}

