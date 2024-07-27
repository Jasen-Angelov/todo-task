<?php

namespace App\Dto\Response;

use App\Enums\StatusCodesEnum;
use App\Enums\SuccessEnum;
use App\Http\Resources\TodoCollection;

class ApiResponseDto
{
    public SuccessEnum $success = SuccessEnum::SUCCESS;
    public StatusCodesEnum $statusCode = StatusCodesEnum::OK;
    public string $message = '';

    public  TodoCollection|null $data = null;
}
