<?php

namespace App\Http\Controllers\Api;

use App\Dto\Response\ApiResponseDto;
use App\Enums\StatusCodesEnum;
use App\Enums\SuccessEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\TodoCreateRequest;
use App\Http\Resources\TodoCollection;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {

        return response()->json($this->createResponse(
            message: '',
            success: SuccessEnum::SUCCESS,
            code: StatusCodesEnum::OK,
            data: new TodoCollection(Todo::all())
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        return response()->json($this->badRequest(code: statusCodesEnum::METHOD_NOT_ALLOWED));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoCreateRequest $request): JsonResponse
    {
        Todo::create($request->validated());

        return response()->json($this->createResponse(
            message: 'Todo created!',
            success: SuccessEnum::SUCCESS,
            code: StatusCodesEnum::ACCEPTED,
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request): JsonResponse
    {
        return response()->json($this->badRequest(code: statusCodesEnum::METHOD_NOT_ALLOWED));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): JsonResponse
    {
        return response()->json($this->badRequest(code: statusCodesEnum::METHOD_NOT_ALLOWED));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        return response()->json($this->badRequest(code: statusCodesEnum::METHOD_NOT_ALLOWED));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mixed $id): JsonResponse
    {
        $validator = Validator::make(['id' => $id], ['id' => 'required|numeric|exists:todos,id']);
        if ($validator->valid()) {
            return response()->json($this->deleteTodo($id));
        }

        return response()->json($this->badRequest(message: json_encode($validator->errors()->getMessages()), code: StatusCodesEnum::UNPROCESSABLE));

    }

    private function badRequest(string $message = 'Resource forbidden', ?StatusCodesEnum $code = null): ApiResponseDto
    {
        return $this->createResponse(message: $message, success: SuccessEnum::ERROR, code: $code);
    }

    private function deleteTodo(int $id): ApiResponseDto
    {
        $result = Todo::destroy($id);
        $message = $result > 0 ? 'Todo has been deleted' : 'Todo has not been deleted';
        $success = $result > 0 ? SuccessEnum::SUCCESS : SuccessEnum::ERROR;

        return $this->createResponse(message: $message, success: $success, code: StatusCodesEnum::ACCEPTED);
    }

    private function createResponse(string $message, ?SuccessEnum $success = null, ?StatusCodesEnum $code = null, TodoCollection|null $data = null): ApiResponseDto
    {
        $response = new ApiResponseDto();
        $response->success = $success ?? SuccessEnum::SUCCESS;
        $response->message = $message;
        $response->statusCode = $code ?? StatusCodesEnum::OK;
        $response->data = $data;
        return $response;
    }
}
