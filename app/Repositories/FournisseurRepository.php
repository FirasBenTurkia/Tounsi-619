<?php

namespace App\Repositories;

use App\Models\Fournisseur;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\FournisseurContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class FournisseurRepository
 *
 * @package \App\Repositories
 */
class FournisseurRepository extends BaseRepository implements FournisseurContract
{
    use UploadAble;

    /**
     * FournisseurRepository constructor.
     * @param Fournisseur $model
     */
    public function __construct(Fournisseur $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listFournisseur(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findFournisseurById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Fournisseur|mixed
     */
    public function createFournisseur(array $params)
    {
        try {
            $collection = collect($params);

            $logo = null;

            if ($collection->has('logo') && ($params['logo'] instanceof  UploadedFile)) {
                $logo = $this->uploadOne($params['logo'], 'fournisseur');
            }

            $merge = $collection->merge(compact('logo'));

            $fournisseur = new Fournisseur($merge->all());

            $fournisseur->save();

            return $fournisseur;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateFournisseur(array $params)
    {
        $fournisseur = $this->findFournisseurById($params['id']);

        $collection = collect($params)->except('_token');

        $fournisseur->update($merge->all());

        return $fournisseur;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteFournisseur($id)
    {
        $fournisseur = $this->findFournisseurById($id);

        if ($fournisseur->logo != null) {
            $this->deleteOne($fournisseur->logo);
        }

        $fournisseur->delete();

        return $fournisseur;
    }
}
