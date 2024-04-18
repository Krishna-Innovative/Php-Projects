<?php

trait AdditionalInformationTrait {

    /**
     * Process the member's additional information
     *
     * @param array $data
     */
    public function processAdditionalInformation($data)
    {
        if (isset($data['personal'])) {
            $this->processPersonalInformation($data['personal']);
        }

        if (isset($data['insurances'])) {
            $this->processCollection($data['insurances'], 'insurances');
        }

        if (isset($data['records'])) {
            $this->processRecords($data['records']);
        }

        if (isset($data['medical'])) {
            $this->processMedical($data['medical']);
        }
    }

    /**
     * Get the member's additional information
     *
     * @return array
     */
    public function getAdditionalInformation()
    {
        return [
            'personal' => $this->personalInformation()->getResults() ?: (object)[],
            'insurances' => $this->insurances()->getResults(),
            'records' => [
                'emergency_messages' => $this->emergencyMessageRecords()->getResults(),
                'living_will' => $this->livingWill()->getResults() ?: (object)[],
            ],
            'medical' => [
                'doctors' => $this->doctors()->getResults(),
                'blood' => $this->blood()->getResults() ?: (object)[],
                'allergies' => $this->allergies()->getResults(),
                'covid_reports' => $this->covids()->getResults(),
                'medications' => $this->medications()->getResults(),
                'immunizations' => $this->immunizations()->getResults(),
                'medical_conditions' => $this->medicalConditions()->getResults(),
                'surgical_history' => $this->surgeries()->getResults(),
                'family_medical_history' => $this->familyMedicalHistory()->getResults(),
                'hospital_records' => $this->hospitalRecords()->getResults(),
                'organ_donor' => $this->organDonorStatus()->getResults() ?: (object)[],
            ],
        ];
    }

    /**
     * Member has personal information
     *
     * @return mixed
     */
    public function personalInformation()
    {
        return $this->hasOne('MemberPersonal', 'member_id', 'id');
    }

    /**
     * Process the member's personal information
     *
     * @param $data
     */
    protected function processPersonalInformation($data)
    {
        return $this->personalInformation()->count() ?
            $this->personalInformation->update($data) : $this->personalInformation()->create($data);
    }

    /**
     * Member has many insurances
     *
     * @return mixed
     */
    public function insurances()
    {
        return $this->hasMany('MemberInsurance', 'member_id', 'id');
    }

    /**
     * Process the member's records
     *
     * @param $data
     */
    protected function processRecords($data)
    {
        if (isset($data['emergency_messages'])) {
            $this->processCollection($data['emergency_messages'], 'emergencyMessageRecords');
        }

        if (isset($data['living_will'])) {
            $this->livingWill()->count() ? $this->livingWill->update($data['living_will']) : $this->livingWill()->create($data['living_will']);
        }

        /*if (isset($data['hospital_records'])) {
            $this->processCollection($data['hospital_records'], 'hospitalRecords');
        }*/
    }

    /**
     * Member has many emergency messages records
     *
     * @return mixed
     */
    public function emergencyMessageRecords()
    {
        return $this->hasMany('MemberEmergencyMessageRecord', 'member_id', 'id');
    }

    /**
     * Member has many living will records
     *
     * @return mixed
     */
    public function livingWill()
    {
        return $this->hasOne('MemberLivingWillRecord', 'member_id', 'id');
    }

    /**
     * Member has many hospital records
     *
     * @return mixed
     */
    public function hospitalRecords()
    {
        return $this->hasMany('MemberHospitalRecord', 'member_id', 'id');
    }

    /**
     * Process the member's records
     *
     * @param $data
     */
    protected function processMedical($data)
    {
        if (isset($data['doctors'])) {
            $this->processCollection($data['doctors'], 'doctors');
        }

        if (isset($data['blood'])) {
            $this->blood()->count() ? $this->blood->update($data['blood']) : $this->blood()->create($data['blood']);
        }

        if (isset($data['allergies'])) {
            $this->processCollection($data['allergies'], 'allergies');
        }
        if (isset($data['covid_reports'])) {
            $this->processCollection($data['covid_reports'], 'covids');
        }

        if (isset($data['medications'])) {
            $this->processCollection($data['medications'], 'medications');
        }

        if (isset($data['immunizations'])) {
            $this->processCollection($data['immunizations'], 'immunizations');
        }

        if (isset($data['medical_conditions'])) {
            $this->processCollection($data['medical_conditions'], 'medicalConditions');
        }

        if (isset($data['surgical_history'])) {
            $this->processCollection($data['surgical_history'], 'surgeries');
        }

        if (isset($data['family_medical_history'])) {
            $this->processCollection($data['family_medical_history'], 'familyMedicalHistory');
        }

        if (isset($data['hospital_records'])) {
            $this->processCollection($data['hospital_records'], 'hospitalRecords');
        }

        if (isset($data['organ_donor'])) {
            $this->organDonorStatus()->count() ? $this->organDonorStatus->update($data['organ_donor']) : $this->organDonorStatus()->create($data['organ_donor']);
        }
    }

    /**
     * Member has many doctors
     *
     * @return mixed
     */
    public function doctors()
    {
        return $this->hasMany('MemberDoctor', 'member_id', 'id');
    }

    /**
     * Member has one blood
     *
     * @return mixed
     */
    public function blood()
    {
        return $this->hasOne('MemberBlood', 'member_id', 'id');
    }

    /**
     * Member has many allergies
     *
     * @return mixed
     */
    public function allergies()
    {
        return $this->hasMany('MemberAllergy', 'member_id', 'id');
    }
    /**
     * Member has many covids reports
     *
     * @return mixed
     */
    public function covids()
    {
        return $this->hasMany('MemberCovid', 'member_id', 'id');
    }

    /**
     * Member has many medications
     *
     * @return mixed
     */
    public function medications()
    {
        return $this->hasMany('MemberMedication', 'member_id', 'id');
    }

    /**
     * Member has many immunizations
     *
     * @return mixed
     */
    public function immunizations()
    {
        return $this->hasMany('MemberImmunization', 'member_id', 'id');
    }

    /**
     * Member has many medical conditions
     *
     * @return mixed
     */
    public function medicalConditions()
    {
        return $this->hasMany('MemberMedicalCondition', 'member_id', 'id');
    }

    /**
     * Member has many surgeries.
     *
     * @return mixed
     */
    public function surgeries()
    {
        return $this->hasMany('MemberSurgery', 'member_id', 'id');
    }

    /**
     * Member has many family medical history.
     *
     * @return mixed
     */
    public function familyMedicalHistory()
    {
        return $this->hasMany('MemberFamilyMedicalHistory', 'member_id', 'id');
    }

    /**
     * Member has one organ donor status.
     *
     * @return mixed
     */
    public function organDonorStatus()
    {
        return $this->hasOne('MemberOrganDonorStatus', 'member_id', 'id');
    }

    /**
     * Process data in a collection
     *
     * @param $data
     * @param $collection
     */
    protected function processCollection($data, $collection)
    {
        $gen = new \PHPQRCode\QRcode();
        $qrGenerator = new \IceAngel\Support\Helpers\QrCode($gen);
        foreach ($data as $entry) {
            if (isset($entry['id'])) {
                if (isset($entry['deleted']) && $entry['deleted']) {
                    $col = $this->$collection()->find($entry['id']);
                    if ($col){
                        $col->delete();
                    }
                }
                else {
                    $this->$collection()->find($entry['id'])->update($entry);
                }
            }
            else {

                // QR code should be here for covid in if condition
                if($collection =='covids' && $entry['scanned']){
                    $entry['public_key'] = md5(rand(100,10000).date('Y-m-d H:i:s'));
                    $qrcodeurl = $qrGenerator->generateAndUploadCovidQR($entry['public_key']);
                    $entry['qrcode'] = $qrcodeurl[0];
                }
                if($collection == 'immunizations' && $entry['scanned']){
                    $entry['public_key'] = md5(rand(100,10000).date('Y-m-d H:i:s'));
                    $qrcodeurl = $qrGenerator->generateAndUploadVaccineQR($entry['public_key']);
                    $entry['qrcode'] = $qrcodeurl[0];
                }
                $this->$collection()->create($entry);
            }
        }
    }

    /**
     * Permissions to access all member's additional information
     *
     * @return array
     */
    public function defaultPermissions()
    {
        return [
            'personal' => $this->processSinglePermissions($this->personalInformation),
            'insurances' => $this->processCollectionPermissions($this->insurances()->getResults()),
            'records' => [
                'emergency_messages' => $this->processCollectionPermissions($this->emergencyMessageRecords()->getResults()),
                // 'living_will' => $this->processCollectionPermissions($this->livingWillRecords()->getResults()),
                'living_will' => $this->processSinglePermissions($this->livingWill),
                
            ],
            'medical' => [
                'doctors' => $this->processCollectionPermissions($this->doctors()->getResults()),
                'blood' => $this->processSinglePermissions($this->blood),
                'allergies' => $this->processCollectionPermissions($this->allergies()->getResults()),
                'medications' => $this->processCollectionPermissions($this->medications()->getResults()),
                'covid_reports' => $this->processCollectionPermissions($this->covids()->getResults()),
                'immunizations' => $this->processCollectionPermissions($this->immunizations()->getResults()),
                'medical_conditions' => $this->processCollectionPermissions($this->medicalConditions()->getResults()),
                'surgical_history' => $this->processCollectionPermissions($this->surgeries()->getResults()),
                'family_medical_history' => $this->processCollectionPermissions($this->familyMedicalHistory()->getResults()),
                'hospital_records' => $this->processCollectionPermissions($this->hospitalRecords()->getResults()),
                'organ_donor' => $this->processSinglePermissions($this->organDonorStatus),
            ],
        ];
    }

    /**
     * Get default permission for model if exists
     *
     * @param $data
     * @return null|array
     */
    protected function processSinglePermissions($data)
    {
        return !is_null($data) ? $data->defaultPermissions() : null;
    }

    /**
     * Get default permissions for every model in the collection
     *
     * @param \Illuminate\Database\Eloquent\Collection $data
     * @return static
     */
    protected function processCollectionPermissions(\Illuminate\Database\Eloquent\Collection $data)
    {
        return $data->map(function (AdditionalInformationBaseModel $entry) {
            return $entry->defaultPermissions();
        })->toArray();
    }

    /**
     * Get the additional information that can be accessed by permissions
     *
     * @param array $permissions
     * @return array
     */
    public function getAdditionalInformationFromPermissions($permissions)
    {
        return [
            'id' => $this->id,
            'ice_id' => $this->ice_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'email' => $this->email,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'nationality' => (int)$this->nationality,
            'phone' => $this->phone,
            'photo' => $this->photo,
            'contacts' => $this->contacts()->toArray(),
            'additional_information' => [
                'personal' => isset($permissions['personal']) ? $this->getFromSinglePermission('personalInformation', $permissions['personal']) : [],
                'insurances' => isset($permissions['insurances']) ? $this->getFromCollectionPermissions('insurances', $permissions['insurances']) : [],
                'records' => [
                    'emergency_messages' => isset($permissions['records']['emergency_messages']) ? $this->getFromCollectionPermissions('emergencyMessageRecords', $permissions['records']['emergency_messages']) : [],
                    'living_will' => isset($permissions['records']['living_will']) ? $this->getFromSinglePermission('livingWill', $permissions['records']['living_will']) : [],
                    
                ],
                'medical' => [
                    'doctors' => isset($permissions['medical']['doctors']) ? $this->getFromCollectionPermissions('doctors', $permissions['medical']['doctors']) : [],
                    'blood' => isset($permissions['medical']['blood']) ? $this->getFromSinglePermission('blood', $permissions['medical']['blood']) : [],
                    'allergies' => isset($permissions['medical']['allergies']) ? $this->getFromCollectionPermissions('allergies', $permissions['medical']['allergies']) : [],
                    'medications' => isset($permissions['medical']['medications']) ? $this->getFromCollectionPermissions('medications', $permissions['medical']['medications']) : [],
                    'covid_reports' => isset($permissions['medical']['covid_reports']) ? $this->getFromCollectionPermissions('covids', $permissions['medical']['covid_reports']) : [],
                    'immunizations' => isset($permissions['medical']['immunizations']) ? $this->getFromCollectionPermissions('immunizations', $permissions['medical']['immunizations']) : [],
                    'medical_conditions' => isset($permissions['medical']['medical_conditions']) ? $this->getFromCollectionPermissions('medicalConditions', $permissions['medical']['medical_conditions']) : [],
                    'surgical_history' => isset($permissions['medical']['surgical_history']) ? $this->getFromCollectionPermissions('surgeries', $permissions['medical']['surgical_history']) : [],
                    'family_medical_history' => isset($permissions['medical']['family_medical_history']) ? $this->getFromCollectionPermissions('familyMedicalHistory', $permissions['medical']['family_medical_history']) : [],
                    'hospital_records' => isset($permissions['medical']['hospital_records']) ? $this->getFromCollectionPermissions('hospitalRecords', $permissions['medical']['hospital_records']) : [],
                    'organ_donor' => isset($permissions['medical']['organ_donor']) ? $this->getFromSinglePermission('organDonorStatus', $permissions['medical']['organ_donor']) : [],
                ],
                'not_all_additional_information'=>(isset($permissions['not_all_additional_information']) && $permissions['not_all_additional_information']) ? true : false,
            ],
        ];
    }

    /**
     * Delete the Member's additional information
     */
    public function deleteAdditionalInformation()
    {
        $this->personalInformation()->delete();
        $this->insurances()->delete();
        $this->emergencyMessageRecords()->delete();
        $this->livingWill()->delete();
        $this->hospitalRecords()->delete();
        $this->doctors()->delete();
        $this->blood()->delete();
        $this->allergies()->delete();
        $this->medications()->delete();
        $this->covids()->delete();
        $this->immunizations()->delete();
        $this->medicalConditions()->delete();
        $this->surgeries()->delete();
        $this->familyMedicalHistory()->delete();
        $this->organDonorStatus()->delete();
    }

    /**
     * Check if the Member has allowed to track his location
     *
     * @return bool
     */
    public function canTrackLocation()
    {
        if (!is_null($this->personalInformation)) {
            return !!$this->personalInformation->location_track;
        }

        return true;
    }

    /**
     * Get permitted fields from HasOne relation
     *
     * @param string $relation
     * @param array $permission
     * @return null
     */
    private function getFromSinglePermission($relation, $permission)
    {
        if (!empty($permission['fields']) && isset($permission['id'])) {

            if ($fields = $this->extractFields($permission)) {
                return $this->$relation()->where('id', $permission['id'])->get($fields)->first();
            }

        }

        return null;
    }

    /**
     * Get permitted fields from HasMany relation
     *
     * @param string $relation
     * @param array $permissions
     * @return array
     */
    private function getFromCollectionPermissions($relation, $permissions)
    {
        $collection = [];

        foreach ($permissions as $permission) {
            if (!is_null($entry = $this->getFromSinglePermission($relation, $permission))) {
                $collection[] = $entry;
            }
        }

        return $collection;
    }

    /**
     * @param $permission
     * @return array
     */
    protected function extractFields($permission)
    {
        $fields = $permission['fields'];

        // Remove "all" field left from the front app
        if (is_numeric($index = array_search('all', $fields))) {
            unset($fields[$index]);
        }

        return empty($fields) ? [] : array_merge($fields, ['id']);
    }
}