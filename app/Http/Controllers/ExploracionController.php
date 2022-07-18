<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Exploracionfisica;
use App\Models\Signovital;

class ExploracionController extends Controller
{
    function store(Request $request){
        //guardamos el interrogtorio
        $exploracion = new Exploracionfisica;
        $exploracion->habitusExterior = $request->habitus;
        $exploracion->peso = $request->peso;
        $exploracion->talla = $request->talla;
        $exploracion->cabeza = $request->cabeza;
        $exploracion->cuello = $request->cuello;
        $exploracion->torax = $request->torax;
        $exploracion->abdomen = $request->abdomen;
        $exploracion->miembros = $request->miembros;
        $exploracion->genitales = $request->genitales;
        $result = $exploracion->save();

        //guardamos la exploracion en la Consulta
        $consulta_id = session('consulta_id');
        $consulta = Consulta::find($consulta_id);
        $consulta->exploracion_id = $exploracion->id;
        $consulta->save();

        if($result !== false){
            session(['explo_id' => $exploracion->id]); //se guarda el id de la exploracion paraa ser usado cuando se guarden los signos vitales 
            return response()->json(['msg' => 'Datos de la Exploración Física guardados exitosamente!'], 200);
        }else{
            return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
        }
    }

    function update(Request $request){
        $explo_id = session('explo_id');
        $exploracion = Exploracionfisica::find($explo_id);
        $exploracion->habitusExterior = $request->habitus;
        $exploracion->peso = $request->peso;
        $exploracion->talla = $request->talla;
        $exploracion->cabeza = $request->cabeza;
        $exploracion->cuello = $request->cuello;
        $exploracion->torax = $request->torax;
        $exploracion->abdomen = $request->abdomen;
        $exploracion->miembros = $request->miembros;
        $exploracion->genitales = $request->genitales;
        $result = $exploracion->save();

        if($result !== false){
            return response()->json(['msg' => 'Datos de la Exploración Física actualizados exitosamente!'], 200);
        }else{
            return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
        }
    }

    function storesignos(Request $request){
        $explo_id = session('explo_id');
        if($explo_id){ //si existe explo_id continuar normalmente
            //guardamos los signos vitales
            $signos = new Signovital;
            $signos->temperatura = $request->temperatura;
            $signos->tensionSistolica = $request->sistolica;
            $signos->tensionDiastolica = $request->diastolica;
            $signos->frecuenciaCardiaca = $request->frecuenciacardiaca;
            $signos->frecuenciaRespiratoria = $request->frecuenciarespiratoria;
            $signos->saturacionOxigeno = $request->saturacion;
            $signos->glucosa = $request->glucosa;

            $result = $signos->save();

            //guardamos los antecedentes en el interrogatorio
            $explo = Exploracionfisica::find($explo_id);
            $explo->signos_id = $signos->id;
            $explo->save();

            if($result !== false){
                session(['signos_id' => $signos->id]); //se guarda el id de los antecedentes pnp para ser usado en actualizar si se llega a recargar la pagina 
                return response()->json(['msg' => 'Signos Vitales guardados exitosamente!'], 200);
            }else{
                return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
            }
        }else{ //si no existe inter_id, primero crear interrogatorio, y luego crear antecedentes hf
            //guardamos el interrogtorio
            $exploracion = new Exploracionfisica;
            $exploracion->save();
            session(['explo_id' => $exploracion->id]);
            $explo_id = $exploracion->id;

            //guardamos el interrogatorio en la consulta
            $consulta_id = session('consulta_id');
            $consulta = Consulta::find($consulta_id);
            $consulta->exploracion_id = $exploracion->id;
            $consulta->save();

            //guardamos los signos
            $signos = new Signovital;
            $signos->temperatura = $request->temperatura;
            $signos->tensionSistolica = $request->sistolica;
            $signos->tensionDiastolica = $request->diastolica;
            $signos->frecuenciaCardiaca = $request->frecuenciacardiaca;
            $signos->frecuenciaRespiratoria = $request->frecuenciarespiratoria;
            $signos->saturacionOxigeno = $request->saturacion;
            $signos->glucosa = $request->glucosa;

            $result = $signos->save();

            //guardamos los signos en la exploracion 
            $explo = Exploracionfisica::find($explo_id);
            $explo->signos_id = $signos->id;
            $explo->save();

            if($result !== false){
                session(['signos_id' => $signos->id]); //se guarda el id de los antecedentes pp para ser usado en actualizar si se llega a recargar la pagina 
                return response()->json(['msg' => 'Signos Vitales guardados exitosamente!'], 200);
            }else{
                return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
            }
        }
    }

    function updatesignos(Request $request){
        $signos_id = session('signos_id');
        //guardamos los signos vitales
        $signos = Signovital::find($signos_id);
        $signos->temperatura = $request->temperatura;
        $signos->tensionSistolica = $request->sistolica;
        $signos->tensionDiastolica = $request->diastolica;
        $signos->frecuenciaCardiaca = $request->frecuenciacardiaca;
        $signos->frecuenciaRespiratoria = $request->frecuenciarespiratoria;
        $signos->saturacionOxigeno = $request->saturacion;
        $signos->glucosa = $request->glucosa;

        $result = $signos->save();

        if($result !== false){
            return response()->json(['msg' => 'Signos Vitales actualizados exitosamente!'], 200);
        }else{
            return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
        }
    }
}
