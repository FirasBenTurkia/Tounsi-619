<?php

namespace App\Contracts;

/**
 * Interface FournisseurContract
 * @package App\Contracts
 */
interface FournisseurContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listFournisseur(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findFournisseurById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createFournisseur(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateFournisseur(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteFournisseur($id);
}
