<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use App\Interfaces\SettingRepositoryInterface;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
class SettingController extends Controller
{

    public function __construct(SettingRepositoryInterface $settingRepository) 
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * @OA\Get(
     *      path="/settings",
     *      operationId="getSetting",
     *      tags={"Settings"},
     *      summary="Get all settings",
     *      description="Returns all settings",
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
            'data' => $this->settingRepository->getSetting()
        ]);
    }
    
    /**
    *@OA\Patch(
    *    path="/settings",
    *    operationId="createSetting",
    *    method="UPDATE",
    *    tags={"Settings"},
    *    summary="Create a new setting",
    *    description="Create a new setting",
    *    @OA\Parameter(
    *          name="key",
    *          description="Setting key",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="string"
    *          )
    *      ),
    *    @OA\Parameter(
    *          name="value",
    *          description="Setting value",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="string"
    *          )
    *      ),
    *    @OA\RequestBody(
    *        required=true,
    *        @OA\MediaType(
    *            mediaType="application/json",
    *            @OA\Schema(
    *                @OA\Property(
    *                    property="key",
    *                    description="Setting key",
    *                    type="string"
    *                ),
    *                @OA\Property(
    *                    property="value",
    *                    description="Setting value",
    *                    type="string"
    *                )
    *            )
    *        )
    *    ),
    *    @OA\Response(
    *        response=200,
    *        description="successful operation",
    *        @OA\Schema(
    *            type="string"
    *        )
    *    ),
    *   @OA\Response(
    *       response=400,
    *       description="Invalid tag value",
    *    ),
    *    @OA\Response(
    *        response=401,
    *        description="Unauthorized action.",
    *    ),
    *    @OA\Response(
    *        response=500,
    *        description="Internal server error",
    *    ),
    *    @OA\Response(
    *        response=405,
    *        description="Invalid HTTP verb used",
    *    ),
    *    security={
    *        {
    *            "oauth2_security_example": {
    *                "write:projects",
    *                "read:projects"
    *            }
    *        }
    *    }
    *)
    */

    
    public function update(Request $request): JsonResponse 
    {
        $data = $request->only(['key','value']);
        $key = $request->key;

        return response()->json([
            'results' => $this->settingRepository->updateSetting($data, $key),
        ]);
    }
}
