<?php

namespace App\Http\Library;

use Illuminate\Http\JsonResponse;
use phpseclib3\File\ASN1\Maps\AttributeTypeAndValue;

trait ApiHelpers
{
    protected function isAdmin($user): bool
    {
        if (!empty($user)) {
            return $user->tokenCan('admin');
        }
        return false;
    }

    protected function isWriter($user): bool
    {
        if (!empty($user)) {
            return $user->tokenCan('writer');
        }
        return false;
    }

    protected function isSubscriber($user): bool
    {
        if (!empty($user)) {
            return $user->tokenCan('subscriber');
        }
        return false;
    }

    protected function onSucces($data, string $message = '', int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function onError(int $code, string $message = ''): JsonResponse
    {
        return response()->json([
            'status' => 'code',
            'message' => $message,
        ], $code);
    }

    protected function postValidationRules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ];
    }

    protected function userValidateRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users' ],
            'password' => ['required', 'string', 'min:8', 'confirmed']  ,
        ];
    }

}
