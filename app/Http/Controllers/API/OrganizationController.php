<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\Eloquent\Organization;

class OrganizationController extends Controller
{
    private $organization;
    private $user;
    private $department;

    public function __construct(Organization $organization)
    {
        $this->organization = $organization;
    }

    public function create(Request $request)
    {
        $data = $request->all();

        // Validate the request
        $organizationValidator =  Validator::make($data,$this->organization->rules());
        $userValidator =  Validator::make($data['user'],User::rules());

        // Check if validation passes
        if($organizationValidator->passes() && $userValidator->passes()){

            // Creating a new User
            $user = User::create($data['user']);
            $user->attachRole('organization');

            // Creating a new organization
            $organization = $this->organization->create($data);
            $organization->user()->save($user);

            // Return User object
            return $organization;
        }else{
            $errors = json_encode(array_merge(json_decode($organizationValidator->errors(), true),json_decode($userValidator->errors(), true)));
            throw new \InvalidArgumentException($errors);
        }
    }
}
