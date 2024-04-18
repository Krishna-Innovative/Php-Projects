<?php

use Illuminate\Database\Eloquent\Model;

class MemberContactPermission extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_contact_permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'contact_id', 'permissions',];

    /**
     * Serialize the permissions field
     *
     * @param $value
     * @return string
     */
    public function setPermissionsAttribute($value)
    {
        $this->attributes['permissions'] = base64_encode(serialize($value));
    }

    /**
     * Un-serialize the permissions field
     *
     * @param $value
     * @return mixed
     */
    public function getPermissionsAttribute($value)
    {
        return unserialize_base64_decode($value);
    }

    /**
     * Find permissions by member id and contact id
     *
     * @param int $memberId
     * @param int $contactId
     * @return mixed
     */
    public static function findByRelation($memberId, $contactId)
    {
        return static::where('member_id', $memberId)->where('contact_id', $contactId)->first();
    }

    /**
     * Delete permission from the given collection
     *
     * @param string $collectionPath
     * @param int $modelId
     */
    public function deletePermissionFromCollection($collectionPath, $modelId)
    {
        $permissions = $this->permissions;

        if (Illuminate\Support\Arr::has($permissions, $collectionPath)) {
            $collection = array_filter(Illuminate\Support\Arr::get($permissions, $collectionPath), function ($item) use ($modelId) {
                return $item['id'] !== $modelId;
            });

            Illuminate\Support\Arr::set($permissions, $collectionPath, $collection);
        }

        $this->update(['permissions' => $permissions]);
    }

    /**
     * Get the member's permissions as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getKey(),
            'member_id' => $this->member_id,
            'contact_id' => $this->contact_id,
            'permissions' => $this->permissions,
        ];
    }
}