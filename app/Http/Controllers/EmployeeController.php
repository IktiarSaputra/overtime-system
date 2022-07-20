<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\EmployeeRepository;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{

    public function __construct(EmployeeRepositoryInterface $employeeRepository) 
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @OA\Get(
     *      path="/employees",
     *      operationId="getEmployee",
     *      tags={"Employees"},
     *      summary="Get all employees",
     *      description="Returns all employees",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid tag value",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized action.",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
     *      @OA\Response(
     *          response=405,
     *          description="Invalid HTTP verb used",
     *      ),
     *      security={
     *         {
     *             "oauth2_security_example": {
     *                 "write:projects",
     *                 "read:projects"
     *             }
     *         }
     *     }
     * )
     */
    public function index()
    {
        return response()->json([
            'result' => $this->employeeRepository->getEmployee()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * @OA\Post(
     *      path="/employees",
     *      operationId="createEmployee",
     *      tags={"Employees"},
     *      summary="Create a new employee",
     *      description="Create a new employee",
     *      @OA\Parameter(
     *          name="name",
     *          description="Employee name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="salary",
     *          description="Employee salary",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
    *        required=true,
    *        @OA\MediaType(
    *            mediaType="application/json",
    *            @OA\Schema(
    *                @OA\Property(
    *                    property="name",
    *                    description="Employee name",
    *                    type="string"
    *                ),
    *                @OA\Property(
    *                    property="salary",
    *                    description="Employee salary",
    *                    type="integer"
    *                )
    *            )
    *        )
    *    ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid tag value",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized action.",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error",
     *      ),
     *      @OA\Response(
     *          response=405,
     *          description="Invalid HTTP verb used",
     *      ),
     *      security={
     *         {
     *             "oauth2_security_example": {
     *                 "write:projects",
     *                 "read:projects"
     *             }
     *         }
     *     }
     * )
     */
    public function store(Request $request): JsonResponse 
    {
        $data = $request->all();

        return response()->json([
            'results' => $this->employeeRepository->storeEmployee($data)
        ], Response::HTTP_CREATED);
    }
}
