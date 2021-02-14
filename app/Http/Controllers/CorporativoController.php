<?php

namespace App\Http\Controllers;

use App\Models\Corporativo;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CorporativoController extends Controller
{

    use ApiResponser;

    public function __construct() {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $corporativos = Corporativo::all();
        return $this->succesResponse($corporativos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =  [
            'S_NombreCorto' => 'required',
            'S_NombreCompleto' => 'required',
            'S_DBName' => 'required',
            'S_DBUsuario' => 'required',
            'S_DBPassword' => 'required',
            'S_SystemUrl' => 'required',
            'D_FechaIncorporacion' => 'required',
            // 'S_LogoURL' => 'required|image|mimes:jpeg,png',
        ];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            return $this->errorResponse([$validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $hashNameFile = "";

        if ($request->file('S_LogoURL')) {

            $file = $request->file('S_LogoURL');
            $hashNameFile = '/corporativo/logos/'. $file->hashName();
            $file->store('public/corporativo/logos');
        }

        $corporativo = new Corporativo($request->all());
        $corporativo->S_LogoURL = $hashNameFile;
        $corporativo->usuarios_id = $request->user()->id;
        $corporativo->save();

        return $this->succesResponse($corporativo, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules =  [
            'S_NombreCorto' => 'required',
            'S_NombreCompleto' => 'required',
            'S_DBName' => 'required',
            'S_DBUsuario' => 'required',
            'S_DBPassword' => 'required',
            'S_SystemUrl' => 'required',
            'D_FechaIncorporacion' => 'required',
            // 'S_LogoURL' => 'required|image|mimes:jpeg,png',
        ];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            return $this->errorResponse([$validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $hashNameFile = "";

        if ($request->file('S_LogoURL')) {

            $file = $request->file('S_LogoURL');
            $hashNameFile = '/corporativo/logos/'. $file->hashName();
            $file->store('public/corporativo/logos');
        }

        $corporativo = Corporativo::findOrfail($id);
        $corporativo->fill($request->all());
        $corporativo->S_LogoURL = $hashNameFile;
        $corporativo->usuarios_id = $request->user()->id;
        $corporativo->update();

        return $this->succesResponse($corporativo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $corporativo = Corporativo::findOrfail($id);
        $corporativo->delete();
        return $this->succesResponse($corporativo);
    }
}
