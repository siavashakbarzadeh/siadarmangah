<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Permissions\Permission;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('companyName', 'asc')
            ->paginate(20);
        return view('companies.companies-list',['companies'=>$companies]);
    }

    public function detail($id)
    {
        $company = Company::find($id);
        return view('companies.company-detail',['company'=>$company]);
    }

    public function new()
    {
        return view('companies.new-company');
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(),[
            'companyName' => 'required'
        ]);
        if($validator->fails()){
            return redirect(route('add-company'))
                ->withInput()
                ->withErrors($validator);
        }
        $company = new Company();
        $company->companyName = $request->companyName;
        $company->address = $request->address;
        $company->code = $request->code;
        $company->city = $request->city;
        $company->telephone1 = $request->telephone1;
        $company->telephone2 = $request->telephone2;
        $result = $company->save();
        if(!$result){
            activity()->log(User::find(auth()->id())->name.'ha modificato l\'azienda'.$company->companyName);
            $flasher->addError('Ops, si è verificato un errore', 'Operazione non conclusa');
            return redirect(route('add-company'));
        }
        $flasher->addSuccess('Azienda aggiunta', 'Operazione conclusa con successo');
        return redirect(route('companies-list'));
    }

    public function edit(Request $request, $id, FlasherInterface $flasher)
    {
        $validator = Validator::make($request->all(),[
            'companyName' => 'required'
        ]);
        if($validator->fails()){
            return redirect(route('company-detail', $id))
                ->withInput()
                ->withErrors($validator);
        }
        $company = Company::find($id);
        $company->companyName = $request->companyName;
        $company->address = $request->address;
        $company->code = $request->code;
        $company->city = $request->city;
        $company->telephone1 = $request->telephone1;
        $company->telephone2 = $request->telephone2;
        $result = $company->save();
        if(!$result){
            $flasher->addError('Ops, si è verificato un errore', 'Operazione non conclusa');
            return redirect(route('company-detail', $id));
        }
        $flasher->addSuccess('Azienda modificata', 'Operazione conclusa con successo');
        return redirect(route('companies-list'));
    }

    public function delete(FlasherInterface $flasher,$id)
    {
        $company = Company::find($id);
        $result = $company->delete();
        if(!$result){
            $flasher->addError('Ops, si è verificato un errore', 'Operazione non conclusa');
            return redirect(route('companies-list'));
        }
        $flasher->addSuccess('Azienda eliminata', 'Operazione conclusa con successo');
        return redirect(route('companies-list'));
    }
}
