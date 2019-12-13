<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\FournisseurContract;
use App\Http\Controllers\BaseController;

class FournisseurController extends BaseController
{
    /**
     * @var FournisseurContract
     */
    protected $fournisseurRepository;

    /**
     * CategoryController constructor.
     * @param FournisseurContract $fournisseurRepository
     */
    public function __construct(FournisseurContract $fournisseurRepository)
    {
        $this->fournisseurRepository = $fournisseurRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $fournisseur = $this->fournisseurRepository->listFournisseur();

        $this->setPageTitle('Fournisseur', 'List of all fournisseur');
        return view('admin.fournisseur.index', compact('fournisseur'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Fournisseur', 'Create Fournisseur');
        return view('admin.fournisseur.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
           
        ]);

        $params = $request->except('_token');

        $fournisseur = $this->fournisseurRepository->createFournisseur($params);

        if (!$fournisseur) {
            return $this->responseRedirectBack('Error occurred while creating fournisseur.', 'error', true, true);
        }
        return $this->responseRedirect('admin.fournisseur.index', 'fournisseur added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $fournisseur = $this->fournisseurRepository->findFournisseurById($id);

        $this->setPageTitle('Fournisseur', 'Edit Fournisseur : '.$fournisseur->name);
        return view('admin.fournisseur.edit', compact('fournisseur'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            
        ]);

        $params = $request->except('_token');

        $fournisseur = $this->fournisseurRepository->updateFournisseur($params);

        if (!$fournisseur) {
            return $this->responseRedirectBack('Error occurred while updating fournisseur.', 'error', true, true);
        }
        return $this->responseRedirectBack('Fournisseur updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $fournisseur = $this->fournisseurRepository->deleteFournisseur($id);

        if (!$fournisseur) {
            return $this->responseRedirectBack('Error occurred while deleting fournisseur.', 'error', true, true);
        }
        return $this->responseRedirect('admin.fournisseur.index', 'Fournisseur deleted successfully' ,'success',false, false);
    }
}
