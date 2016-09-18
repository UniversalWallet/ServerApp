<?php

namespace App\Http\Controllers;

use App\Models\Support\ValidatingTrait;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    protected $viewBase  = 'dashboard';
    protected $routeBase = 'dashboard';

    /** @var Model|EloquentBuilder|ValidatingTrait|SoftDeletes */
    private $model;

    protected $viewRoot;
    protected $routeRoot;

    protected $itemName = 'item';
    protected $itemsName = 'items';

    protected $indexWith = [];
    protected $editWith = [];

    protected $sorted = false;
    protected $orderBy = null;
    protected $orderByDirection = 'asc';

    protected $entityName = 'Сущность';
    protected $entityNameGender = 'f';

    protected $restorable = false;
    protected $seoble = false;

    protected $imageAttributes = [];
    protected $imageFolderName = 'items';

    /**
     * Установка основных настроек.
     *
     * @param Model $modelClass
     * @param string $viewRoot
     * @param null $routeRoot
     */
    protected function setModel($modelClass, $viewRoot = '', $routeRoot = null)
    {
        $this->model = new $modelClass;

        $this->viewRoot = $viewRoot;
        $this->routeRoot = $routeRoot ? $routeRoot : $this->viewRoot;
    }

    /**
     * Установка названия сущности.
     *
     * @param string $entityName
     * @param string $entityNameGender
     */
    protected function setEntityName($entityName = 'Сущность', $entityNameGender = 'f')
    {
        $this->entityName = $entityName;
        $this->entityNameGender = $entityNameGender;
    }

    /**
     * Установка названий переменных, передаваемых в представления.
     *
     * @param string $itemName
     * @param string $itemsName
     */
    protected function setItemNames($itemName = 'item', $itemsName = 'items')
    {
        $this->itemName = $itemName;
        $this->itemsName = $itemsName;
    }

    /**
     * Установка связей, загружающихся вместе с сущностью.
     *
     * @param array $indexWith
     * @param array $editWith
     */
    protected function setWiths($indexWith = [], $editWith = [])
    {
        $this->indexWith = $indexWith;
        $this->editWith = $editWith;
    }

    /**
     * Установка сортировки сущностей.
     *
     * @param bool $sorted
     * @param string|null $orderBy
     * @param string $orderByDirection
     */
    protected function setSorting($sorted = false, $orderBy = null, $orderByDirection = 'asc')
    {
        $this->sorted = $sorted;
        $this->orderBy = $orderBy;
        $this->orderByDirection = $orderByDirection;
    }

    /**
     * Установка восстанавливаемости для сущности.
     *
     * @param bool $restorable
     */
    protected function setRestorable($restorable = false)
    {
        $this->restorable = $restorable;
    }

    /**
     * Установка SEO для сущности.
     *
     * @param bool $seoble
     */
    protected function setSeoble($seoble = false)
    {
        $this->seoble = $seoble;
    }

    /**
     * Установка аттрибутов-изображений сущности.
     *
     * @param array $imageAttributes
     * @param string $imageFolderName
     */
    protected function setImageAttributes($imageAttributes = [], $imageFolderName = 'items')
    {
        $this->imageAttributes = $imageAttributes;
        $this->imageFolderName = $imageFolderName;
    }

//    /**
//     * Показ страницы просмотра списка сущностей.
//     *
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function index()
//    {
//        return $this->indexResponse($this->indexData());
//    }

    /**
     * Валидация запроса по ключу метода.
     *
     * @param Request $request
     * @param string $methodKey
     */
    protected function validateRequest(Request $request, $methodKey)
    {
        $this->validate(
            $request,
            call_user_func([$this->model, 'getRulesFor'], $methodKey),
            call_user_func([$this->model, 'getValidationMessages'])
        );
    }

    /**
     * Данные для метода index.
     *
     * @return array
     */
    protected function indexData()
    {
        $items = $this->model->with($this->indexWith);
        /** @var EloquentBuilder|QueryBuilder $items */
        if ($this->sorted) {
            $items = $items->sorted();
        } elseif ($this->orderBy) {
            $items = $items->orderBy($this->orderBy, $this->orderByDirection);
        }
        $items = $items->get();
        return [
            $this->itemsName => $items
        ];
    }

    /**
     * Ответ метода index.
     *
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function indexResponse($data = [])
    {
        return view("$this->viewBase.$this->viewRoot.index", $data);
    }

//    /**
//     * Показ страницы создания сущности.
//     *
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function create()
//    {
//        return $this->createResponse([]);
//    }

    /**
     * Ответ метода create.
     *
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function createResponse($data = [])
    {
        return view("$this->viewBase.$this->viewRoot.create", $data);
    }

//    /**
//     * Создание сущности.
//     *
//     * @param Request $request
//     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
//     */
//    public function store(Request $request)
//    {
//        $item = $this->storePerform($request->all());
//        return $this->storeResponse($item->id);
//    }

    /**
     * Выполнение создания сущности.
     *
     * @param array $data
     * @param array $necessaryFields
     * @return EloquentBuilder|Model
     */
    protected function storePerform($data, $necessaryFields = [])
    {
        $item = $this->model;
        $additionalData = [];
        foreach ($necessaryFields as $name => $defaultValue) {
            $additionalData[$name] = isset($data[$name]) ? $data[$name] : $defaultValue;
        }
//        foreach ($this->imageAttributes as $attributeName => $isEssential) {
//            $additionalData[$attributeName] = array_key_exists($attributeName, $data) ? $this->imageUploader->upload(
//                    $data[$attributeName], $this->imageFolderName
//                ) : null;
//        }
        $item->fill(array_merge($data, $additionalData))->save();
        return $item;
    }

    /**
     * Ответ метода store.
     *
     * @param int|null $id
     * @param string|null|bool $customRoute
     * @param array $params
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function storeResponse($id = null, $customRoute = false, $params = [])
    {
        return $this->success(
            "$this->entityName успешно создан".($this->entityNameGender == 'f' ? 'a' : ($this->entityNameGender == 'n' ? 'о' : '')).".",
            $customRoute !== false ? $customRoute : route("$this->routeBase.$this->routeRoot.edit", array_merge([0 => $id], $params))
        );
    }

//    /**
//     * Показ страницы изменения сущности.
//     *
//     * @param int $id
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     */
//    public function edit($id)
//    {
//        return $this->editResponse($this->editData($id));
//    }

    /**
     * Данные для метода edit.
     *
     * @param int $id
     * @return array
     */
    protected function editData($id)
    {
        $item = $this->model->with($this->editWith)->findOrFail($id);
        return [
            $this->itemName => $item
        ];
    }

    /**
     * Ответ метода edit.
     *
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function editResponse($data = [])
    {
        return view("$this->viewBase.$this->viewRoot.edit", $data);
    }

    /**
     * Данные для метода view.
     *
     * @param int $id
     * @param boolean $allowTrashed
     * @return array
     */
    protected function viewData($id, $allowTrashed = true)
    {
        $item = $this->model;
        if ($this->restorable && $allowTrashed) {
            $item = $item->withTrashed();
        }
        $item = $item->with($this->editWith)->findOrFail($id);
        return [
            $this->itemName => $item
        ];
    }

    /**
     * Ответ метода view.
     *
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function viewResponse($data = [])
    {
        return view("$this->viewBase.$this->viewRoot.view", $data);
    }

//    /**
//     * Изменение сущности.
//     *
//     * @param int $id
//     * @param Request $request
//     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
//     */
//    public function update($id, Request $request)
//    {
//        $item = $this->updatePerform($id, $request);
//        return $this->updateResponse($item->id);
//    }

    /**
     * Выполнение изменения сущности.
     *
     * @param int $id
     * @param array $data
     * @param array $necessaryFields
     * @return EloquentBuilder|Model
     */
    protected function updatePerform($id, $data, $necessaryFields = [])
    {
        $item = $this->model->findOrFail($id);
        $additionalData = [];
        foreach ($necessaryFields as $name => $defaultValue) {
            $additionalData[$name] = isset($data[$name]) ? $data[$name] : $defaultValue;
        }
//        foreach ($this->imageAttributes as $attributeName => $isEssential) {
//            $additionalData[$attributeName] = $item->image;
//            if (! $isEssential && array_key_exists('remove_'.$attributeName, $data)) {
//                $this->imageUploader->delete($additionalData[$attributeName]);
//                $additionalData[$attributeName] = null;
//            } elseif (array_key_exists($attributeName, $data)) {
//                $additionalData[$attributeName] = $this->imageUploader->update(
//                    $additionalData[$attributeName], $data[$attributeName], $this->imageFolderName
//                );
//            }
//        }
        $item->fill(array_merge($data, $additionalData))->save();
        return $item;
    }

    /**
     * Ответ метода update.
     *
     * @param int|null $id
     * @param string|null|bool $customRoute
     * @param array $params
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function updateResponse($id = null, $customRoute = false, $params = [])
    {
        return $this->success(
            "$this->entityName успешно измен".($this->entityNameGender == 'f' ? 'ена' : ($this->entityNameGender == 'n' ? 'ено' : 'ён')).".",
            $customRoute !== false ? $customRoute : route("$this->routeBase.$this->routeRoot.edit", array_merge([0 => $id], $params))
        );
    }

//    /**
//     * Удаление сущности.
//     *
//     * @param int $id
//     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
//     */
//    public function delete($id)
//    {
//        $item = $this->deletePerform($id);
//        return $this->deleteResponse($item->id);
//    }

    protected function deletePerform($id)
    {
        $item = $this->model->findOrFail($id);
        $item->delete();
        return $item;
    }

    /**
     * Ответ метода delete.
     *
     * @param int $id
     * @param string|null|bool $customRoute
     * @param string|bool $customMessage
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function deleteResponse($id, $customRoute = false, $customMessage = false)
    {
        return $this->warning(
            ($customMessage !== false ? $customMessage : ("$this->entityName успешно удал".($this->entityNameGender == 'f' ? 'ена' : ($this->entityNameGender == 'n' ? 'ено' : 'ён')).'.')).($this->restorable ? ' '.message_link(route("$this->routeBase.$this->routeRoot.restore", $id), 'Отменить.') : ''),
            $customRoute !== false ? $customRoute : null
        );
    }

//    /**
//     * Восстановление удалённой сущности.
//     *
//     * @param int $id
//     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
//     */
//    public function restore($id)
//    {
//        $this->restorePerform($id);
//        return $this->restoreResponse();
//    }

    /**
     * Выполнение восстановления сущности.
     *
     * @param $id
     * @return mixed
     */
    protected function restorePerform($id)
    {
        $item = $this->model->withTrashed()->findOrFail($id);
        /** @var Model|SoftDeletes $item */
        $item->restore();
        return $item;
    }

    /**
     * Ответ метода restore.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function restoreResponse()
    {
        return $this->success(
            "$this->entityName успешно восстановлен".($this->entityNameGender == 'f' ? 'а' : ($this->entityNameGender == 'n' ? 'о' : ''))."."
        );
    }

//    /**
//     * Присоединение SEO-полей к сущности.
//     *
//     * @param Model|SeobleInterface $item
//     * @param array $seoInputs
//     */
//    protected function attachSeo($item, $seoInputs = [])
//    {
//        $this->syncSeo($item, $seoInputs);
//    }
}
