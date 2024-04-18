<?php

class ContentsController extends ApiController {

     /**
     * @var FlysystemManager
     */
    var $expiration = 7776000;

    /**
     * @var string
     */
    var $slug;

    /**
     * Get General contents.
     *
     * @return array
     */
    public function index()
    {
        Cache::forget('contents');
        //cache for 3 months
        $contents = Cache::remember('contents', $this->expiration, function(){

            return [
                // 'countries' => Country::all(),
                'query_types' => QueryType::all(),
                'security_questions' => SecurityQuestion::all(),
                'allergies' => [
                    'categories' => AllergyCategory::with('Allergies')->get(),
                    'reactions' => AllergyReaction::all(),
                    'severities' => AllergySeverity::all(),
                ],
                'blood_types' => BloodType::all(),
                'doctor_specialities' => DoctorSpeciality::all(),
                'family_history' => [
                    'conditions' => FamilyHistoryCondition::all(),
                    'members' => FamilyMember::all(),
                    'severities' => FamilyHistorySeverity::all(),
                ],
                'hospitalisation_reasons' => HospitalisationReason::all(),
                'immunizations' => Immunization::all(),
                'vaccineDosages' => VaccineDosage::all(),
                'marital_statuses' => Marital::all(),
                'medicals' => [
                    'conditions' => MedicalCondition::all(),
                    'statuses' => MedicalConditionStatus::all(),
                ],
                'medications' => [
                    'dosages' => MedicationDosage::all(),
                    'frequencies' => MedicationFrequency::all(),
                    'statuses' => MedicationStatus::all(),
                ],
                'organ_donor' => [
                    'statuses' => OrganDonorStatus::all(),
                    'conditions' => OrganDonorCondition::all(),
                ],
                'surgeries' => Surgery::all(),
                'homepage_slides' => HomepageSlide::all(),
                'insurance_types' => InsuranceType::all(),
                'genders' => Gender::all(),
            ];

        });

        return $contents;
    }

    /**
     * Get static page by slug.
     *
     * @param $slug
     * @return mixed
     */
    public function getPage($slug)
    {
        $this->slug = $slug;
        Cache::forget('page:'.$slug);
        $page = Cache::remember('page:'.$slug, $this->expiration, function(){
            return Page::where('slug', $this->slug)->first();
        });

        if (is_null($page)){
            Cache::forget('page:'.$slug);
        }

        return $page ?: $this->respondWithError('PageNotFoundException', '', 404);
    }
    public function getCovidContents()
    {
        return Response::json(Covid::all());
    }

    public function getVaccineDosages(){
        App::setLocale(Request::header('Accept-Language'));
        $rec = VaccineDosage::all()->toArray();
        foreach($rec as $key=>$value){
            $rec[$key]['name']=VaccineDosage::where(['id'=>$value['id']])->first()->getName();
        }
        return Response::json(['doseList'=>$rec]);
    }

}