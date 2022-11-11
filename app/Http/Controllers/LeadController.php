<?php

namespace App\Http\Controllers;

use App\Http\Middleware\FechingLeads;
use App\Http\Requests\LeadRequest;
use App\Http\Resources\LeadCollection;
use App\Http\Resources\LeadResource;
use Src\BoundedContext\Lead\Infrastructure\CreateLeadController;
use Src\BoundedContext\Lead\Infrastructure\GetLeadByIdController;
use Src\BoundedContext\Lead\Infrastructure\GetLeadsController;
use Tymon\JWTAuth\Facades\JWTAuth;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware(FechingLeads::class)->only(['store', 'update']);
    }
    public function index(GetLeadsController $controller)
    {
        $user = JWTAuth::user();
        $leads = $controller->__invoke($user->role, $user->_id);
        return new LeadCollection($leads);
    }
    public function store(LeadRequest $request, CreateLeadController $controller)
    {
        $lead =  $controller->__invoke(
            JWTAuth::user()->_id,
            $request
        );
        return new LeadResource($lead);
    }

    public function show(string $id, GetLeadByIdController $controller)
    {
        $user = JWTAuth::user();
        $lead = $controller->__invoke(
            $id,
            $user->role,
            $user->_id
        );
        return new LeadResource($lead);
    }
}
