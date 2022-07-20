<?php

namespace App\Http\Controllers;

use App\Models\Overtime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Interfaces\OvertimeRepositoryInterface;
use App\Repositories\OvertimeRepository;

class OvertimeController extends Controller
{
    private OvertimeRepositoryInterface $overtimeRepository;

    public function __construct(OvertimeRepositoryInterface $overtimeRepository)
    {
        $this->overtimeRepository = $overtimeRepository;
    }

    /**
     * @OA\Get(
     *      path="/overtimes",
     *      operationId="getOvertime",
     *      tags={"Overtimes"},
     *      summary="Get all overtimes",
     *      description="Returns all overtimes",
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
            'result' => $this->overtimeRepository->getOvertime()
        ]);
    }

   
    /**
     * @OA\Post(
     *      path="/overtimes",
     *      operationId="storeOvertime",
     *      tags={"Overtimes"},
     *      summary="Create a new overtime",
     *      description="Create a new overtime",
     *    
    *      @OA\RequestBody(
    *        required=true,
    *        @OA\MediaType(
    *            mediaType="application/json",
    *            @OA\Schema(
    *                @OA\Property(
    *                    property="employee_id",
    *                    description="Employee id",
    *                    type="integer"
    *                ),
    *                @OA\Property(
    *                    property="date",
    *                    description="Date",
    *                    format="Y-m-d",
    *                    type="date"
    *                ),
    *                @OA\Property(
    *                    property="time_start",
    *                    description="Time start",
    *                    format="H:i:s",
    *                    type="datetime"
    *                ),
    *                @OA\Property(
    *                    property="time_ended",
    *                    description="Time ended",
    *                    format="H:i",
    *                    type="datetime"
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
    public function store(Request $request)
    {
        $data = $request->all();

        return response()->json([
            'results' => $this->overtimeRepository->storeOvertime($data)
        ], Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/overtime-pays/calculate",
     *      operationId="getOvertimePay",
     *      tags={"Overtimes"},
     *      summary="Get all overtime pays",
     *      description="Returns all overtime pays",
     *      @OA\RequestBody(
    *        required=true,
    *        @OA\MediaType(
    *            mediaType="application/json",
    *            @OA\Schema(
    *                @OA\Property(
    *                    property="month",
    *                    description="Month",
    *                    format="Y-m",
    *                    type="date"
    *                ),
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
    public function overtimePaysCalculate(Request $request)
    {
        $data = $request->all();

        return response()->json([
            'results' => $this->overtimeRepository->getOvertimePay($data)
        ]);
    }
}
