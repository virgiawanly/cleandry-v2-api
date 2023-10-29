<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Outlet;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationService
{
    /**
     * Register a new user and create its first company and outlet.
     */
    public function register(Request $request): array
    {
        try {
            DB::beginTransaction();

            $companyImage = null;
            if ($request->hasFile('company_logo')) {
                $companyImage = $request->file('company_logo')->store('companies');
            }

            $company = Company::create([
                'name' => $request->company_name,
                'phone' => $request->company_phone,
                'email' => $request->company_email,
                'website' => $request->company_website,
                'logo' => $companyImage,
            ]);

            $outlet =  Outlet::withoutCompanyScope()->create([
                'company_id' => $company->id,
                'name' => $request->outlet_name,
                'address' => $request->outlet_address,
                'email' => $request->outlet_email,
                'phone' => $request->outlet_phone,
            ]);

            $user = User::create([
                'company_id' => $company->id,
                'outlet_id' => $outlet->id,
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);

            DB::commit();

            $token = $user->createToken('auth_token')->plainTextToken;
            $user->update(['last_login_at' => now()]);

            return [
                'user' => $user,
                'token' => $token,
            ];
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
