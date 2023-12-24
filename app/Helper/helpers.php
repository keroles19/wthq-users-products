<?php


/**
 * return success response
 *
 * @param int $statusCode
 * @param mixed $data
 * @param int $code
 * @param string $hint
 * @return array
 */
if (!function_exists('successResponse')) {
    function successResponse(int $statusCode, mixed $data, int $code = 1022, string $hint = 'Process successfully'): array
    {
        if ($statusCode == 201) {
            $code = 1021;
            $hint = 'Resource created successfully';
        }

        $result['status_code'] = $statusCode;
        $result['code'] = $code;
        $result['hint'] = $hint;
        $result['success'] = true;
        $result['data'] = $data;

        return $result;
    }
}


/**
 * return failed response
 *
 * @param int $statusCode
 * @param array $errors
 * @param int $code
 * @param string $hint
 *
 * @return array
 */
if (!function_exists('failedResponse')) {

    function failedResponse(int $statusCode, array $errors, int $code = 1040, $hint = ''): array
    {
        $statusCodes = [
            401 => [1041, 'Unauthenticated'],
            403 => [1043, 'Forbidden'],
            404 => [1044, 'Resource not found'],
            409 => [1049, 'Method Not Allowed'],
            422 => [1422, 'Unprocessable Entity'],
            500 => [1050, 'Server error'],
        ];

        if (isset($statusCodes[$statusCode])) {
            $code = $statusCodes[$statusCode][0];
            $hint = $statusCodes[$statusCode][1];
        }

        return [
            'status_code' => $statusCode,
            'code' => $code,
            'hint' => $hint,
            'success' => false,
            'errors' => $errors,
        ];
    }
}


/**
 * upload  function
 *
 * @param string $image
 * @param string $folder
 *
 * @return string
 */
if (!function_exists('upload')) {
    function upload($image, $folder, $oldFile = null): string
    {
        if ($oldFile) {
            deleteFile('uploads/' . $folder . '/' . $oldFile);
        }

        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/' . $folder), $image_name);
        return $image_name;
    }
}

if (!function_exists('deleteFile')) {
    function deleteFile($folderWithFile): void
    {
        if (file_exists(public_path('uploads/' . $folderWithFile))) {
            unlink(public_path('uploads/' . $folderWithFile));
        }
    }
}

// get Type of authenticated user
if (!function_exists('getAuthUserType')) {
    function getAuthUserType(): string
    {
        return auth()->user()->type;
    }
}