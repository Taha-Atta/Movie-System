<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\LoginResource;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Repository\Customer\Auth\ILoginCustomerInterface;
use App\Repository\Customer\Auth\ILogoutCustomerInterface;
use App\Repository\Customer\Auth\IRegisterCustomerInterface;


class AuthController extends Controller
{
    public $RegisterCustomer;
    public $LoginCustomer;
    public $LogoutCustomer;

    public function __construct(
        IRegisterCustomerInterface $RegisterInterface,
        ILoginCustomerInterface $LoginInterface,
        ILogoutCustomerInterface $LogoutInterface
    ) {
        $this->RegisterCustomer = $RegisterInterface;
        $this->LoginCustomer = $LoginInterface;
        $this->LogoutCustomer = $LogoutInterface;
    }
    /**
     * @OA\Post(
     *     path="/api/customer/register",
     *     summary="Register a new user",
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="User's name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User's email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="User's type",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *    @OA\Parameter(
     *         name="age",
     *         in="query",
     *         description="User's age",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="201", description="User registered successfully"),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */
    public function CustomerRegister(RegisterRequest $request)
    {
        $user =  $this->RegisterCustomer->CustomerRegister($request);
        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json([
            'data' => new RegisterResource($user),
            'token ' => $token,
            'status' => 201,
        ], 201);
    }
    /**
     * @OA\Post(
     *     path="/api/customer/login",
     *     summary="Authenticate user and generate  token",
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User's email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Login successful"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function CustomerLogin(LoginRequest $request)
    {

        $data =  $this->LoginCustomer->CustomerLogin($request);
        if ($data) {
            return response()->json([
                'data' => $data,
                'status' => 201,
            ], 201);
        } else {
            return response()->json([
                'msg' => 'email or password is wrong',
                'status' => 401,
            ], 401);
        }
    }
   /**
     * @OA\Post(
     *     path="/api/customer/logout",
     *     summary="customer logout",
     *     @OA\Response(response="200", description=" logout Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function CustomerLogout(Request $request)
    {
        $this->LogoutCustomer->CustomerLogout($request);

        return  response()->json([
            'msg' => 'user logout successfuly',
        ]);
    }
}
