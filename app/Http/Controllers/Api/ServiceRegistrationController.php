<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booster;
use App\Models\Center;
use App\Models\CenterSynchronizeRule;
use App\Models\CenterVaccineName;
use App\Models\ManPowerSchedule;
use App\Models\PcrTest;
use App\Models\RapidPCRCenter;
use App\Models\Synchronize;
use App\Models\User;
use App\Models\UserAndSynchronizeRule;
use App\Models\Vaccination;
use App\Models\VaccineName;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
class ServiceRegistrationController extends Controller
{

    public function vaccinationCenterSelect(Request $request)
    {
        $userArray = json_decode($request->getContent(), true);
        $cityId = $userArray['city_id'];
        $synchronizeRuleId = $userArray['synchronizeRuleId'];

        $centers = CenterSynchronizeRule::where('center_id', '!=', null)->where('city_id', $cityId)->where('synchronize_id', $synchronizeRuleId)->select('center_id')->get();
        $centerInfo = [];

        $i = 0;
        foreach ($centers as $key => $center)
        {
            $centerInfo[$key] = Center::where('id', $center->center_id)->select(['id', 'name'])->first();
        }

        if (!empty($centerInfo))
        {
            return response()->json([
                "centers"=>$centerInfo,
                "status"=>"1",
            ]);
        }else{
            return response()->json([
                "message"=>"Please select another City Or Vaccine",
                "status"=>"0",
            ]);
        }
    }

    public function pcrCenterSelect(Request $request)
    {
        $userArray = json_decode($request->getContent(), true);
        $cityId = $userArray['city_id'];
        $synchronizeRuleId = $userArray['synchronizeRuleId'];

        $centers = CenterSynchronizeRule::where('center_id', '!=', null)->where('city_id', $cityId)->where('synchronize_id', $synchronizeRuleId)->select('center_id')->get();
        $centerInfo = [];

        $i = 0;
        foreach ($centers as $key => $center)
        {
            $centerInfo[$key] = Center::where('id', $center->center_id)->select(['id', 'name'])->first();
        }

        if (!empty($centerInfo))
        {
            return response()->json([
                "centers"=>$centerInfo,
                "status"=>"1",
            ]);
        }else{
            return response()->json([
                "message"=>"Please select another City Or PCR",
                "status"=>"0",
            ]);
        }

    }
    public function rtPcrCenterSelect(Request $request)
    {
        $userArray = json_decode($request->getContent(), true);
        $cityId = $userArray['city_id'];
        $synchronizeRuleId = $userArray['synchronizeRuleId'];

        $centers = CenterSynchronizeRule::where('rapid_pcr_center_id', '!=', null)->where('city_id', $cityId)->where('synchronize_id', $synchronizeRuleId)->select('rapid_pcr_center_id')->get();
        $centerInfo = [];

        $i = 0;
        foreach ($centers as $key => $center)
        {
            $centerInfo[$key] = RapidPCRCenter::where('id', $center->rapid_pcr_center_id)->select(['id', 'name'])->first();
        }

        if (!empty($centerInfo))
        {
            return response()->json([
                "centers"=>$centerInfo,
                "status"=>"1",
            ]);
        }else{
            return response()->json([
                "message"=>"Please select another City Or Rt-PCR",
                "status"=>"0",
            ]);
        }

    }

    public function boosterCenterSelect(Request $request)
    {
        $userArray = json_decode($request->getContent(), true);
        $cityId = $userArray['city_id'];
        $synchronizeRuleId = $userArray['synchronizeRuleId'];

        $centers = CenterSynchronizeRule::where('center_id', '!=', null)->where('city_id', $cityId)->where('synchronize_id', $synchronizeRuleId)->select('center_id')->get();
        $centerInfo = [];

        $i = 0;
        foreach ($centers as $key => $center)
        {
            $centerInfo[$key] = Center::where('id', $center->center_id)->select(['id', 'name'])->first();
        }

        if (!empty($centerInfo))
        {
            return response()->json([
                "centers"=>$centerInfo,
                "status"=>"1",
            ]);
        }else{
            return response()->json([
                "message"=>"Please select another City Or Booster",
                "status"=>"0",
            ]);
        }
    }

    public function vaccineName(){
        $synchronizes = Synchronize::where('type', 'vaccine')->where('status', '1')->select(['id', 'synchronize_rule'])->get();
        if (count($synchronizes) > 0)
        {
            return response()->json([
                "vaccineName"=>$synchronizes,
                "status"=>"1",
            ]);
        }else{
            return response()->json([
                "message"=>"Something wrong",
                "status"=>"0",
            ]);
        }
    }

    public function pcrName(){
        $synchronizes = Synchronize::where('type', 'pcr')->where('status', '1')->select(['id', 'synchronize_rule'])->get();
        if (count($synchronizes) > 0)
        {
            return response()->json([
                "pcrName"=>$synchronizes,
                "status"=>"1",
            ]);
        }else{
            return response()->json([
                "message"=>"Something wrong",
                "status"=>"0",
            ]);
        }
    }
    public function rtPcrName(){
        $synchronizes = Synchronize::where('type', 'rtpcr')->where('status', '1')->select(['id', 'synchronize_rule'])->get();
        if (count($synchronizes) > 0)
        {
            return response()->json([
                "rtPcrName"=>$synchronizes,
                "status"=>"1",
            ]);
        }else{
            return response()->json([
                "message"=>"Something wrong",
                "status"=>"0",
            ]);
        }
    }

    public function boosterName(){
        $synchronizes = Synchronize::where('type', 'booster')->where('status', '1')->select(['id', 'synchronize_rule'])->get();
        if (count($synchronizes) > 0)
        {
            return response()->json([
                "boosterName"=>$synchronizes,
                "status"=>"1",
            ]);
        }else{
            return response()->json([
                "message"=>"Something wrong",
                "status"=>"0",
            ]);
        }
    }

    public function vaccineRegistration(Request $request)
    {
        $userArray = json_decode($request->getContent(), true);
        $phone = $userArray['phone'];
        $centerId = $userArray['center_id'];
        $date = $userArray['date'];
        $synchronize = Synchronize::find($userArray['synchronizeRuleId']);
        $nameOfVaccine = $synchronize->synchronize_rule;

        $user = User::where('phone', $phone)->select(['id', 'name'])->first();
        $existVaccination = Vaccination::where('user_id', $user->id)->first();

        if ($existVaccination)
        {
            return response()->json([
                "message"=>"You are already registered for Vaccination. Thank you",
                "status"=>"2",
            ]);
        }

        $registrationCheck = ManPowerSchedule::where('center_id', $centerId)->where('date', $date)->select(['vaccine_available_set', 'id'])->first();

        if ($registrationCheck==null){
            return response()->json([
                "message"=>"Sorry ! It is not available.Please Select another date",
                "status"=>"0",
            ]);
        }elseif(!$registrationCheck->vaccine_available_set > 0)
        {
            return response()->json([
                "message"=>"Sorry ! It is not available. Please Select another date",
                "status"=>"0",
            ]);

        }else{


            $vaccine = new Vaccination();
            $vaccine->user_id = $user->id;
            $vaccine->center_id = $centerId;
            $vaccine->date_of_registration = Carbon::parse($date);
            $vaccine->registration_type = "normal";
            $vaccine->name_of_vaccine = $nameOfVaccine;
            $vaccine->synchronize_id = $synchronize->id;

            $center = Center::where('id', $centerId)->select(['name','address'])->first();
            $userName = $user->name;
            $centerName = $center->name;
            $centerAddress = $center->address;

            if ($vaccine->save())
            {
                ManPowerSchedule::find($registrationCheck->id)->decrement('vaccine_available_set');

                // send sms via helper function
                send_sms('Congratulations '.$userName.'!! You are successfully registered for Vaccination. Your center name is: '.$centerName.','.$centerAddress.', date of vaccination : '.Carbon::parse($date), $phone);

                return response()->json([
                    "message"=>"You are successfully registered for Vaccination",
                    "status"=>"1",
                ]);
            }else{
                return response()->json([
                    "message"=>"Something wrong",
                    "status"=>"0",
                ]);
            }
        }
    }

    public function testImageStore(Request $request){
        $userArray = json_decode($request->getContent(), true);

        $originalExtension = str_ireplace("image/","",$userArray['document']['type']);
        $folder_path       = 'uploads/images/documents/';
        $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$originalExtension;

        $decodedBase64 = $userArray['document']['data'];
        try {
            Image::make($decodedBase64)->save($folder_path.$image_new_name);
            return response()->json([
                "message"=>"You are successfully submit your information",
                "status"=>"1",
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "message"=>$exception->getMessage(),
                "status"=>"0",
            ]);
        }
    }
    public function updateProfilePicture(Request $request){
        $userArray = json_decode($request->getContent(), true);
        $phone = $userArray['phone'];
        $user = User::where('phone', $phone)->select(['id', 'name','image'])->first();

        if($userArray['document']['data']){
            if($user->image != null){
                File::delete(public_path($user->image));
            }
            $originalExtension = str_ireplace("image/","",$userArray['document']['type']);
            $folder_path       = 'uploads/images/documents/';
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$originalExtension;
            $decodedBase64 = $userArray['document']['data'];
        }

        try {
            Image::make($decodedBase64)->save($folder_path.$image_new_name);
            $user->image = $folder_path.$image_new_name;
            $user->save();
            return response()->json([
                "message"=>"Profile image updated ",
                "status"=>"1",
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "message"=>$exception->getMessage(),
                "status"=>"0",
            ]);
        }
    }
    public function externalVaccination(Request $request)
    {
        $userArray = json_decode($request->getContent(), true);
        $phone = $userArray['phone'];
        $synchronize = Synchronize::find($userArray['synchronizeRuleId']);

        $center = $userArray['center'];
        $firstDose = $userArray['firstDose'];
        $secondDose = $userArray['secondDose'];
        $selectedDose = $userArray['selectedDose'];
        $description = $userArray['description'];
        $centerLocation = $userArray['centerLocation'];

        $user = User::where('phone', $phone)->select(['id'])->first();
        $existVaccination = Vaccination::where('user_id', $user->id)->first();

        $vaccineName = $synchronize->synchronize_rule;

        if ($existVaccination)
        {
            return response()->json([
                "message"=>"You are already registered for Vaccination. Thank you",
                "status"=>"2",
            ]);
        }

        $vaccine = new Vaccination();

        $vaccine->user_id = $user->id;
        $vaccine->name_of_vaccine = $vaccineName;
        $vaccine->registration_type = "normal";
        $vaccine->center_name = $center;
        $vaccine->center_location = $centerLocation;
        $vaccine->description = $description;
        $vaccine->center_type = "external";

        if($selectedDose === '1st Dose' || $selectedDose === 'Both Dose'){
            $vaccine->date_of_first_dose = Carbon::parse($firstDose);
            $vaccine->first_dose_status = 1;
            $vaccine->date_of_registration =  Carbon::parse($firstDose);
        }
        if($selectedDose === '2nd Dose'){
            if($vaccine->date_of_first_dose === null){
                return response()->json([
                    "message"=>"Please attach first dose.",
                    "status"=>"0",
                ]);
            }
        }

        if($selectedDose === '2nd Dose' || $selectedDose === 'Both Dose'){
            $vaccine->date_of_second_dose = Carbon::parse($secondDose);
            $vaccine->status = 1;
            $vaccine->antibody_last_date = Carbon::parse($secondDose)->addDays(30);

            // Synchronize record store
            UserAndSynchronizeRule::where('user_id', $user->id)->where('synchronize_id', $synchronize->id)->delete();
            $userAndSynchronizeRule = new UserAndSynchronizeRule();
            $userAndSynchronizeRule->user_id = $user->id;
            $userAndSynchronizeRule->synchronize_id = $synchronize->id;
            $userAndSynchronizeRule->save();
        }

        if($userArray['document']['type'] && $userArray['document']['data']){
            // code for image save by base64 data
            $originalExtension = str_ireplace("image/","",$userArray['document']['type']);
            $folder_path       = 'uploads/images/documents/';
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$originalExtension;
            $decodedBase64 = $userArray['document']['data'];
            Image::make($decodedBase64)->save($folder_path.$image_new_name);
            $vaccine->document = $folder_path.$image_new_name;
        }

        try {
            if ($vaccine->save())
            {
                return response()->json([
                    "message"=>"You are successfully submit your information",
                    "status"=>"1",
                ]);
            }else{
                return response()->json([
                    "message"=>"Something wrong",
                    "status"=>"0",
                ]);
            }

        } catch (\Exception $exception) {
            return response()->json([
                "message"=>'Something went wrong. ' . $exception->getMessage(),
                "status"=>"0",
            ]);
        }
    }

    public function externalVaccinationDoseTwo(Request $request)
    {
        $userArray = json_decode($request->getContent(), true);
        $phone = $userArray['phone'];
        // $vaccineName = $userArray['vaccineName'];
        $center = $userArray['center'];
        $secondDose = $userArray['secondDose'];
        $selectedDose = $userArray['selectedDose'];
        $description = $userArray['description'];
        $centerLocation = $userArray['centerLocation'];

        $synchronize = Synchronize::find($userArray['synchronizeRuleId']);
        $vaccineName = $synchronize->synchronize_rule;
        $user = User::where('phone', $phone)->select(['id'])->first();
        $existVaccination = Vaccination::where('user_id', $user->id)->first();

        $vaccine = $existVaccination;

        $vaccine->user_id = $user->id;
        $vaccine->name_of_vaccine = $vaccineName;
        $vaccine->center_name = $center;
        $vaccine->center_location = $centerLocation;
        $vaccine->description = $description;

        if($selectedDose === '2nd Dose'){
            $vaccine->date_of_second_dose = Carbon::parse($secondDose);
            $vaccine->status = 1;
            $vaccine->antibody_last_date = Carbon::parse($secondDose)->addDays(30);

            // Synchronize record store
            UserAndSynchronizeRule::where('user_id', $user->id)->where('synchronize_id', $synchronize->id)->delete();
            $userAndSynchronizeRule = new UserAndSynchronizeRule();
            $userAndSynchronizeRule->user_id = $user->id;
            $userAndSynchronizeRule->synchronize_id = $synchronize->id;
            $userAndSynchronizeRule->save();
        }

        if($userArray['document']['type'] && $userArray['document']['data']){
            // code for image save by base64 data
            $originalExtension = str_ireplace("image/","",$userArray['document']['type']);
            $folder_path       = 'uploads/images/documents/';
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$originalExtension;
            $decodedBase64 = $userArray['document']['data'];
            Image::make($decodedBase64)->save($folder_path.$image_new_name);
            $vaccine->document_two = $folder_path.$image_new_name;
        }

        try {
            if ($vaccine->save())
            {
                return response()->json([
                    "message"=>"You are successfully submit your information",
                    "status"=>"1",
                ]);
            }else{
                return response()->json([
                    "message"=>"Something wrong",
                    "status"=>"0",
                ]);
            }

        } catch (\Exception $exception) {
            return response()->json([
                "message"=>'Something went wrong. ' . $exception->getMessage(),
                "status"=>"0",
            ]);
        }
    }

    public function prcRegistration(Request $request)
    {
        $userArray = json_decode($request->getContent(), true);
        $phone = $userArray['phone'];
        $centerId = $userArray['center_id'];
        $date = $userArray['date'];

        $synchronize = Synchronize::find($userArray['synchronizeRuleId']);

        $user = User::where('phone', $phone)->select(['id', 'name'])->first();

        $existPcr= PcrTest::where('user_id', $user->id)->first();

        if($existPcr){
            if ($existPcr->date_of_registration != null)
            {
                return response()->json([
                    "message"=>"You are already registered for PCR Test. Thank you",
                    "status"=>"2",
                ]);
            }
        }

        $registrationCheck = ManPowerSchedule::where('center_id', $centerId)->where('date', $date)->select(['pcr_available_set', 'id'])->first();


        if ($registrationCheck==null){
            return response()->json([
                "message"=>"Sorry ! It is not available.Please Select another date",
                "status"=>"0",
            ]);
        }elseif($registrationCheck->pcr_available_set < 1)
        {
            return response()->json([
                "message"=>"Sorry ! It is not available. Please Select another date",
                "status"=>"0",
            ]);

        }else {

            if(!$existPcr)
            {
                $existPcr = new PcrTest();
            }

            $existPcr->user_id = $user->id;
            $existPcr->center_id = $centerId;
            $existPcr->date_of_registration = Carbon::parse($date);
            $existPcr->registration_type = "normal";
            $existPcr->synchronize_id = $synchronize->id;

            $center = Center::where('id', $centerId)->select(['name','address'])->first();
            $userName = $user->name;
            $centerName = $center->name;
            $centerAddress = $center->address;

            if ($existPcr->save()) {

                ManPowerSchedule::find($registrationCheck->id)->decrement('pcr_available_set');

                // send sms via helper function
                send_sms('Congratulations '.$userName.' !! You are successfully registered for PCR Test. Your center name is: '.$centerName.','.$centerAddress.', date of PCR test : '.Carbon::parse($date), $phone);

                return response()->json([
                    "message" => "You are successfully registered for PCR",
                    "status" => "1",
                ]);
            } else {
                return response()->json([
                    "message" => "Something wrong",
                    "status" => "0",
                ]);
            }
        }

    }

    public function boosterRegistration(Request $request)
    {
        $userArray = json_decode($request->getContent(), true);
        $phone = $userArray['phone'];
        $centerId = $userArray['center_id'];
        $date = $userArray['date'];
        $synchronize = Synchronize::find($userArray['synchronizeRuleId']);
        $nameOfVaccine = $synchronize->synchronize_rule;

        $user = User::where('phone', $phone)->select(['id', 'name'])->first();
        $existBooster= Booster::where('user_id', $user->id)->first();
        if ($existBooster)
        {
            return response()->json([
                "message"=>"You are already registered for Pcr Booster. Thank You",
                "status"=>"2",
            ]);
        }

        $registrationCheck = ManPowerSchedule::where('center_id', $centerId)->where('date', $date)->select(['booster_available_set', 'id'])->first();

        if ($registrationCheck==null){
            return response()->json([
                "message"=>"Sorry ! It is not available.Please Select another date",
                "status"=>"0",
            ]);
        }elseif(!$registrationCheck->booster_available_set > 0)
        {
            return response()->json([
                "message"=>"Sorry ! It is not available. Please Select another date",
                "status"=>"0",
            ]);

        }else {
            $booster = new Booster();
            $booster->user_id = $user->id;
            $booster->center_id = $centerId;
            $booster->date_of_registration = Carbon::parse($date);
            $booster->registration_type = "normal";
            $booster->synchronize_id = $synchronize->id;
            $booster->name_of_vaccine = $nameOfVaccine;

            $center = Center::where('id', $centerId)->select(['name','address'])->first();
            $userName = $user->name;
            $centerName = $center->name;
            $centerAddress = $center->address;

            if ($booster->save()) {

                ManPowerSchedule::find($registrationCheck->id)->decrement('booster_available_set');

                // send sms via helper function
                send_sms('Congratulation '.$userName.' !! You are successfully registered for Booster dose. Your center name is: '.$centerName.','.$centerAddress.' , date of Booster : '.Carbon::parse($date), $phone);

                return response()->json([
                    "message" => "You are successfully registered for Booster",
                    "status" => "1",
                ]);
            } else {
                return response()->json([
                    "message" => "Something wrong",
                    "status" => "0",
                ]);
            }
        }
    }
}
