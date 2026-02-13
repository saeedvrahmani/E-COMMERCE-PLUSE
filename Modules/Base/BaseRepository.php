<?php


use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Container\Container as Application;

abstract class BaseRepository
{

    protected ?Model $model = null;
    protected Application $app;
    protected bool $withCache = false;
protected  int $ttl = 600 ;
    protected string $tag = '';

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function makeModel(): Model
    {
        if ($this->model instanceof Model) {
            return $this->model;
        }
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new \RuntimeException("Class {$this->model()} must be instance of " . Model::class);
        }
        return $this->model = $model;
    }

    abstract public function model(): string;

    public function paginate(
        string $search = '',
        int    $perPage = 15,
        array  $relations = [],
        array  $columns = ['*']
    ): LengthAwarePaginator
    {
        return $this->allQuery($search, $relations)->paginate($perPage, $columns);
    }
protected function cache(string $key , Closure $callback)
{
    if (! $this->withCache){
        return $callback;
    }
    return Cache::tags([$this->tag])
        ->remember($key , $this->ttl , $callback);
}
    public function allQuery(string $search = '', array $relations = [], int $skip = null, ?int $limit = null): Builder
    {
        $query = $this->model->newQuery()->with($relations);
        if (!empty($search)) {
            $searchable = $this->getFieldSearchable();
            $query->where(
                function ($q) use ($searchable, $search) {
                    foreach ($searchable as $field) {
                        $q->orWhere($field, 'like', "%{$search}%");
                    }
                }
            );
        }
        if (!is_null($skip)) {
            $query->skip($skip);
        }
        if (!is_null($limit)) {
            $query->limit($limit);
        }
        return $query;
    }

    abstract public function getFieldSearchable(): array;

    public function all(
        string $search = '',
        array  $relations = [],
        ?int   $skip = null,
        ?int   $limit = null,
        array  $columns = ['*']
    ): Collection
    {
        $query = $this->allQuery($search, $relations, $skip, $limit);
        return $query->get($columns);
    }

    public function trash(array $columns = ['*']): ?array
    {
        return $this->model->newQuery()->onlyTrashed()->get($columns);
    }

    public function create(array $input): Model
    {
        $this->clearCache();
        $model = $this->model->newInstance($input);
        $model->save();
        return $model;
    }

    public function clearCache(): void
    {
       Cache::tags([$this->tag])->flush();
    }

    public function update(array $input, int $id): Model
    {
        $this->clearCache();
        $query = $this->model->newQuery();
        $model = $query->findOrFail($id);
        $model->fill($input);
        $model->save();
        return $model;
    }

    public function duplicate(int $id): Model
    {
        $model = $this->find($id);
        $this->clearCache();
        return $model->replicate();
    }

    public function find(int $id, array $load = [], array $columns = ['*']): ?Model
    {
        $query = $this->model->newQuery();
        return $query->findOrFail($id, $columns)->load($load);
    }

    public function delete(int $id): ?bool
    {
        $this->clearCache();
        $query = $this->model->newQuery();
        $model = $query->findOrFail($id);
        return $model->delete();
    }

    public function forceDelete(int $id): bool
    {
        $this->clearCache();
        $model = $this->findWithTrash($id);
        return $model->forceDelete();
    }

    public function findWithTrash(int $id): ?Model
    {
        $query = $this->model->newQuery();
        return $query->withTrashed()->findOrFail($id);
    }

    public function restore(int $id): bool
    {
        $query = $this->model->newQuery();
        $model = $query->withTrashed()->findOrFail($id);
        return $model->restore();
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function where(...$conditions): Builder
    {
        return $this->makeModel()->newQuery()->where(...$conditions);
    }

    public function updateWhere(array $input, ...$conditions): Model
    {
        $this->clearCache();
        $query = $this->model->newQuery();
        $model = $query->where(...$conditions)->firstOrFail();
        $model->fill($input);
        $model->save();
        return $model;
    }

}
