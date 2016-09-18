<?php 

namespace App\Library\Support;

use Request;
use URL;

trait ResponseTrait
{
    /**
     * Возвращает универсальный успешный ответ
     *
     * @param string $route
     * @param string $message
     * @param array $params
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function success($message = '', $route = null, $params = [])
    {
        return $this->successfulResponse($message, $route, $params);
    }

    /**
     * Возвращает универсальный успешный ответ c пометкой warning
     *
     * @param string $route
     * @param string $message
     * @param array $params
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function warning($message = '', $route = null, $params = [])
    {
        return $this->successfulResponse($message, $route, $params, 'warning');
    }

    /**
     * Возвращает универсальный успешный ответ
     *
     * @param string $message
     * @param null $route
     * @param array $params
     * @param string $dataKey
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    private function successfulResponse($message = '', $route = null, $params = [], $dataKey = 'success')
    {
        if (Request::ajax() || Request::wantsJson()) {
            return response()->json(array_merge(['success' => true, 'message' => $message], (array) $params));
        } else {
            $redirect = redirect()->to(is_null($route) ? URL::previous() : $route);
            if ($message) {
                $redirect = $redirect->with($dataKey, $message);
            }
            foreach($params as $key => $value) {
                $redirect = $redirect->with($key, $value);
            }
            return $redirect;
        }
    }

    /**
     * Возвращает универсальный неуспешный ответ
     *
     * @param string $route
     * @param array $messages
     * @param array $params
     * @param array $exceptInput
     * @param int $status
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function error($messages = [], $route = null, $params = [], $exceptInput = ['password', 'password_confirmation'], $status = 400)
    {
        if (Request::ajax() || Request::wantsJson()) {
            return response()->json(array_merge(['success' => false, 'errors' => (array) $messages], (array) $params))->setStatusCode($status);
        } else {
            $redirect = redirect()->to(is_null($route) ? URL::previous() : $route)
                ->withErrors($messages)
                ->withInput(Request::except($exceptInput));
            foreach($params as $key => $value) {
                $redirect = $redirect->with($key, $value);
            }
            return $redirect;
        }
    }
}
