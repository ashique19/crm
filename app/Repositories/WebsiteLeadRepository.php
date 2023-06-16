<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\WebsiteLead;
class WebsiteLeadRepository
{
    public function getLeadById($id)
    {
         
        $lead     = WebsiteLead::findOrFail($id);
        return response()->json(array($lead), 200);
    }
}    