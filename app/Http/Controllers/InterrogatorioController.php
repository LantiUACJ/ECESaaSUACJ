<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Interrogatorio;
use App\Models\Antecedenteshf;
use App\Models\Antecedentespnp;
use App\Models\Antecedentespp;
use App\Models\Interrogatorioaparato;

class InterrogatorioController extends Controller
{
    //Funcion ya no usada desde que interrogatorio se separa de consulta y se convierte en la historia clinica del paciente. 
    function store(Request $request){
        //guardamos el interrogtorio
        $interrogatorio = new Interrogatorio;
        $interrogatorio->grupo_id = $request->grupo == 0? null: $request->grupo;
        $interrogatorio->padecimientoActual = $request->padecimiento;
        $result = $interrogatorio->save();

        //guardamos el interrogatorio en la consulta
        $consulta_id = session('consulta_id');
        $consulta = Consulta::find($consulta_id);
        $consulta->interrogatorio_id = $interrogatorio->id;
        $consulta->save();

        if($result !== false){
            session(['inter_id' => $interrogatorio->id]); //se guarda el id del interrogatorio para ser usado cuando se guarden los interrogatorios 
            return response()->json(['msg' => 'Datos de Interrogatorio guardados exitosamente!'], 200);
        }else{
            return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
        }
    }

    //Al igual que store, update queda en desuso.
    function update(Request $request){
        //actualizamos el interrogtorio
        $inter_id = session('inter_id');
        $interrogatorio = Interrogatorio::find($inter_id);
        $interrogatorio->grupo_id = $request->grupo == 0? null: $request->grupo;
        $interrogatorio->padecimientoActual = $request->padecimiento;
        $result = $interrogatorio->save();

        if($result !== false){
            return response()->json(['msg' => 'Datos de Interrogatorio actualizados exitosamente!'], 200);
        }else{
            return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
        }
    }

    //Las funciones de store y update de los antecedentes deben crear el interrogatorio para el paciente de la consulta en caso de que no existan.
    function storeantehf(Request $request){
        $inter_id = session('inter_id');
        if($inter_id){ //si existe inter_id continuar normalmente
            //guardamos los antecedentes hf
            $antecedenteshf = new Antecedenteshf;
            $antecedenteshf->grupo_id = isset($request->grupo)? $request->grupo: null;
            $antecedenteshf->diabetes = $request->diabetes;
            $antecedenteshf->hipertension = $request->hipertension;
            $antecedenteshf->dislipidemias = $request->dislipidemias;
            $antecedenteshf->neoplasias = $request->neoplasias;
            $antecedenteshf->tuberculosis = $request->tuberculosis;
            $antecedenteshf->artritis = $request->artritis;
            $antecedenteshf->cardiopatias = $request->cardiopatias;
            $antecedenteshf->alzheimer = $request->alzheimer;
            $antecedenteshf->epilepsia = $request->epilepsia;
            $antecedenteshf->parkinson = $request->parkinson;
            $antecedenteshf->esclerosisMultiple = $request->esclerosis;
            $antecedenteshf->trastornoAnsiedad = $request->trastorno;
            $antecedenteshf->depresion = $request->depresion;
            $antecedenteshf->esquizofrenia = $request->esquizofrenia;
            $antecedenteshf->Cirrosis = $request->cirrosis;
            $antecedenteshf->colestasis = $request->colestasis;
            $antecedenteshf->hepatitis = $request->hepatitis;
            $antecedenteshf->alergias = $request->alergias;
            $antecedenteshf->enfermedadesEndocrinas = $request->endocrinas;
            $antecedenteshf->enfermedadesGeneticas = $request->geneticas;
            $antecedenteshf->otros = $request->otros;

            $result = $antecedenteshf->save();

            //guardamos los antecedentes en el interrogatorio
            $inter = Interrogatorio::find($inter_id);
            $inter->anteHF_id = $antecedenteshf->id;
            $inter->save();

            if($result !== false){
                session(['anteHF_id' => $antecedenteshf->id]); //se guarda el id de los antecedentes hf para ser usado en actualizar si se llega a recargar la pagina 
                return response()->json(['msg' => 'Antecedentes Heredo Familiares guardados exitosamente!'], 200);
            }else{
                return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
            }
        }else{ //si no existe inter_id, primero crear Interrogatorio, y luego crear antecedentes hf
            //guardamos el interrogtorio

            $interrogatorio = new Interrogatorio;
            $interrogatorio->paciente_id = session('pac_id');
            $interrogatorio->padecimientoActual = null;
            $interrogatorio->save();

            session(['inter_id' => $interrogatorio->id]);
            $inter_id = $interrogatorio->id;

            //guardamos los antecedenteshf
            $antecedenteshf = new Antecedenteshf;
            $antecedenteshf->grupo_id = isset($request->grupo)? $request->grupo: null;
            $antecedenteshf->diabetes = $request->diabetes;
            $antecedenteshf->hipertension = $request->hipertension;
            $antecedenteshf->dislipidemias = $request->dislipidemias;
            $antecedenteshf->neoplasias = $request->neoplasias;
            $antecedenteshf->tuberculosis = $request->tuberculosis;
            $antecedenteshf->artritis = $request->artritis;
            $antecedenteshf->cardiopatias = $request->cardiopatias;
            $antecedenteshf->alzheimer = $request->alzheimer;
            $antecedenteshf->epilepsia = $request->epilepsia;
            $antecedenteshf->parkinson = $request->parkinson;
            $antecedenteshf->esclerosisMultiple = $request->esclerosis;
            $antecedenteshf->trastornoAnsiedad = $request->trastorno;
            $antecedenteshf->depresion = $request->depresion;
            $antecedenteshf->esquizofrenia = $request->esquizofrenia;
            $antecedenteshf->Cirrosis = $request->cirrosis;
            $antecedenteshf->colestasis = $request->colestasis;
            $antecedenteshf->hepatitis = $request->hepatitis;
            $antecedenteshf->alergias = $request->alergias;
            $antecedenteshf->enfermedadesEndocrinas = $request->endocrinas;
            $antecedenteshf->enfermedadesGeneticas = $request->geneticas;
            $antecedenteshf->otros = $request->otros;

            $result = $antecedenteshf->save();

            //guardamos los antecedentes en el interrogatorio
            $inter = Interrogatorio::find($inter_id);
            $inter->anteHF_id = $antecedenteshf->id;
            $inter->save();

            if($result !== false){
                session(['anteHF_id' => $antecedenteshf->id]); //se guarda el id de los antecedentes hf para ser usado en actualizar si se llega a recargar la pagina 
                return response()->json(['msg' => 'Antecedentes Heredo Familiares guardados exitosamente!'], 200);
            }else{
                return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
            }
        }
    }

    function updateantehf(Request $request){
        //guardamos los antecedentes hf
        $anteHF_id = session('anteHF_id');
        $antecedenteshf = Antecedenteshf::find($anteHF_id);
        $antecedenteshf->grupo_id = $request->grupo == 0? null: $request->grupo;
        $antecedenteshf->diabetes = $request->diabetes;
        $antecedenteshf->hipertension = $request->hipertension;
        $antecedenteshf->dislipidemias = $request->dislipidemias;
        $antecedenteshf->neoplasias = $request->neoplasias;
        $antecedenteshf->tuberculosis = $request->tuberculosis;
        $antecedenteshf->artritis = $request->artritis;
        $antecedenteshf->cardiopatias = $request->cardiopatias;
        $antecedenteshf->alzheimer = $request->alzheimer;
        $antecedenteshf->epilepsia = $request->epilepsia;
        $antecedenteshf->parkinson = $request->parkinson;
        $antecedenteshf->esclerosisMultiple = $request->esclerosis;
        $antecedenteshf->trastornoAnsiedad = $request->trastorno;
        $antecedenteshf->depresion = $request->depresion;
        $antecedenteshf->esquizofrenia = $request->esquizofrenia;
        $antecedenteshf->Cirrosis = $request->cirrosis;
        $antecedenteshf->colestasis = $request->colestasis;
        $antecedenteshf->hepatitis = $request->hepatitis;
        $antecedenteshf->alergias = $request->alergias;
        $antecedenteshf->enfermedadesEndocrinas = $request->endocrinas;
        $antecedenteshf->enfermedadesGeneticas = $request->geneticas;
        $antecedenteshf->otros = $request->otros;

        $result = $antecedenteshf->save();

        if($result !== false){
            return response()->json(['msg' => 'Antecedentes Heredo Familiares actualizados exitosamente!'], 200);
        }else{
            return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
        }
    }

    function storeantepp(Request $request){
        $inter_id = session('inter_id');
        if($inter_id){ //si existe inter_id continuar normalmente
            
            $toxicojson = $request->toxicomanias != null? json_encode($request->toxicomanias): null;
            
            //guardamos los antecedentes pp
            $antecedentespp = new Antecedentespp;
            $antecedentespp->enfermedadInfectaContagiosa = $request->infectacontagiosa;
            $antecedentespp->enfermedadCronicaDegenerativa = $request->cronicodegenerativa;
            $antecedentespp->traumatologicos = $request->traumatologicos;
            $antecedentespp->alergicos = $request->alergicos;
            $antecedentespp->quirurgicos = $request->quirurgicos;
            $antecedentespp->hospitalizacionesPrevias = $request->hospitalizaciones;
            $antecedentespp->transfusiones = $request->transfusiones;
            $antecedentespp->toxicomaniasAlcoholismo = $toxicojson;
            $antecedentespp->otros = $request->otros;

            $result = $antecedentespp->save();

            //guardamos los antecedentes en el interrogatorio
            $inter = Interrogatorio::find($inter_id);
            $inter->antePP_id = $antecedentespp->id;
            $inter->save();

            if($result !== false){
                session(['antePP_id' => $antecedentespp->id]); //se guarda el id de los antecedentes pp para ser usado en actualizar si se llega a recargar la pagina 
                return response()->json(['msg' => 'Antecedentes Personales Patológicos guardados exitosamente!'], 200);
            }else{
                return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
            }
        }else{ //si no existe inter_id, primero crear interrogatorio, y luego crear antecedentes hf
            //guardamos el interrogtorio
            
            $interrogatorio = new Interrogatorio;
            $interrogatorio->paciente_id = session('pac_id');
            $interrogatorio->padecimientoActual = null;
            $interrogatorio->save();

            session(['inter_id' => $interrogatorio->id]);
            $inter_id = $interrogatorio->id;

            $toxicojson = $request->toxicomanias != null? json_encode($request->toxicomanias): null;

            //guardamos los antecedenteshf
            $antecedentespp = new Antecedentespp;
            $antecedentespp->enfermedadInfectaContagiosa = $request->infectacontagiosa;
            $antecedentespp->enfermedadCronicaDegenerativa = $request->cronicodegenerativa;
            $antecedentespp->traumatologicos = $request->traumatologicos;
            $antecedentespp->alergicos = $request->alergicos;
            $antecedentespp->quirurgicos = $request->quirurgicos;
            $antecedentespp->hospitalizacionesPrevias = $request->hospitalizaciones;
            $antecedentespp->transfusiones = $request->transfusiones;
            $antecedentespp->toxicomaniasAlcoholismo = $toxicojson;
            $antecedentespp->otros = $request->otros;

            $result = $antecedentespp->save();

            //guardamos los antecedentes en el interrogatorio
            $inter = Interrogatorio::find($inter_id);
            $inter->antePP_id = $antecedentespp->id;
            $inter->save();

            if($result !== false){
                session(['antePP_id' => $antecedentespp->id]); //se guarda el id de los antecedentes pp para ser usado en actualizar si se llega a recargar la pagina 
                return response()->json(['msg' => 'Antecedentes Personales Patológicos guardados exitosamente!'], 200);
            }else{
                return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
            }
        }
    }

    function updateantepp(Request $request){
        $antePP_id = session('antePP_id');
        //guardamos los antecedentes pp
        
        $toxicojson = $request->toxicomanias != null? json_encode($request->toxicomanias): null;

        $antecedentespp = Antecedentespp::find($antePP_id);
        $antecedentespp->enfermedadInfectaContagiosa = $request->infectacontagiosa;
        $antecedentespp->enfermedadCronicaDegenerativa = $request->cronicodegenerativa;
        $antecedentespp->traumatologicos = $request->traumatologicos;
        $antecedentespp->alergicos = $request->alergicos;
        $antecedentespp->quirurgicos = $request->quirurgicos;
        $antecedentespp->hospitalizacionesPrevias = $request->hospitalizaciones;
        $antecedentespp->transfusiones = $request->transfusiones;
        $antecedentespp->toxicomaniasAlcoholismo = $toxicojson;
        $antecedentespp->otros = $request->otros;

        $result = $antecedentespp->save();

        if($result !== false){
            return response()->json(['msg' => 'Antecedentes Personales Patológicos actualizados exitosamente!'], 200);
        }else{
            return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
        }
    }

    function storeantepnp(Request $request){
        $inter_id = session('inter_id');
        if($inter_id){ //si existe inter_id continuar normalmente
            //guardamos los antecedentes pnp
            $antecedentespnp = new Antecedentespnp;
            $antecedentespnp->vivienda = $request->vivienda;
            $antecedentespnp->higiene = $request->higiene;
            $antecedentespnp->dieta = $request->dieta;
            $antecedentespnp->zoonosis = $request->zoonosis;
            $antecedentespnp->otros = $request->otros;

            $result = $antecedentespnp->save();

            //guardamos los antecedentes en el interrogatorio
            $inter = Interrogatorio::find($inter_id);
            $inter->antePNP_id = $antecedentespnp->id;
            $inter->save();

            if($result !== false){
                session(['antePNP_id' => $antecedentespnp->id]); //se guarda el id de los antecedentes pnp para ser usado en actualizar si se llega a recargar la pagina 
                return response()->json(['msg' => 'Antecedentes Personales No Patológicos guardados exitosamente!'], 200);
            }else{
                return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
            }
        }else{ //si no existe inter_id, primero crear Interrogatorio, y luego crear antecedentes hf
            //guardamos el interrogtorio
            $interrogatorio = new Interrogatorio;
            $interrogatorio->paciente_id = session('pac_id');
            $interrogatorio->padecimientoActual = null;
            $interrogatorio->save();

            session(['inter_id' => $interrogatorio->id]);
            $inter_id = $interrogatorio->id;

            //guardamos los antecedentespnp
            $antecedentespnp = new Antecedentespnp;
            $antecedentespnp->vivienda = $request->vivienda;
            $antecedentespnp->higiene = $request->higiene;
            $antecedentespnp->dieta = $request->dieta;
            $antecedentespnp->zoonosis = $request->zoonosis;
            $antecedentespnp->otros = $request->otros;

            $result = $antecedentespnp->save();

            //guardamos los antecedentes en el interrogatorio
            $inter = Interrogatorio::find($inter_id);
            $inter->antePNP_id = $antecedentespnp->id;
            $inter->save();

            if($result !== false){
                session(['antePNP_id' => $antecedentespnp->id]); //se guarda el id de los antecedentes pp para ser usado en actualizar si se llega a recargar la pagina 
                return response()->json(['msg' => 'Antecedentes Personales No Patológicos guardados exitosamente!'], 200);
            }else{
                return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
            }
        }
    }

    function updateantepnp(Request $request){
        $antePNP_id = session('antePNP_id');
        //guardamos los antecedentes pnp
        $antecedentespnp = Antecedentespnp::find($antePNP_id);
        $antecedentespnp->vivienda = $request->vivienda;
        $antecedentespnp->higiene = $request->higiene;
        $antecedentespnp->dieta = $request->dieta;
        $antecedentespnp->zoonosis = $request->zoonosis;
        $antecedentespnp->otros = $request->otros;

        $result = $antecedentespnp->save();

        if($result !== false){
            return response()->json(['msg' => 'Antecedentes Personales No Patológicos actualizados exitosamente!'], 200);
        }else{
            return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
        }
    }

    function storeaparatos(Request $request){
        $inter_id = session('inter_id');
        if($inter_id){ //si existe inter_id continuar normalmente
            //guardamos el interrogatorio de AS
            $interrogatorioaparato = new Interrogatorioaparato;
            $interrogatorioaparato->signosYsintomas = $request->signos;
            $interrogatorioaparato->aparatoCardiovascular = $request->cardiovascular;
            $interrogatorioaparato->aparatoRespiratorio = $request->respiratorio;
            $interrogatorioaparato->aparatoDigestivo = $request->digestivo;
            $interrogatorioaparato->sistemaNefro = $request->nefro;
            $interrogatorioaparato->sistemaEndocrino = $request->endocrino;
            $interrogatorioaparato->sistemaHemato = $request->hematopoyetico;
            $interrogatorioaparato->sistemaNervioso = $request->nervioso;
            $interrogatorioaparato->sistemaMusculoEsqueletico = $request->musculo;
            $interrogatorioaparato->pielYtegumentos = $request->piel;
            $interrogatorioaparato->organosSentidos = $request->sentidos;
            $interrogatorioaparato->esferaPsiquica = $request->psiquica;

            $result = $interrogatorioaparato->save();

            //guardamos el inter aparatos y sistemas en el interrogatorio
            $inter = Interrogatorio::find($inter_id);
            $inter->interAS_id = $interrogatorioaparato->id;
            $inter->save();

            if($result !== false){
                session(['interAS_id' => $interrogatorioaparato->id]); //se guarda el id de los AS para ser usado en actualizar si se llega a recargar la pagina 
                return response()->json(['msg' => 'Interrogatorio de Aparatos y Sistemas guardados exitosamente!'], 200);
            }else{
                return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
            }
        }else{ //si no existe inter_id, primero crear interrogatorio, y luego crear antecedentes hf
            //guardamos el interrogtorio
            $interrogatorio = new Interrogatorio;
            $interrogatorio->paciente_id = session('pac_id');
            $interrogatorio->padecimientoActual = null;
            $interrogatorio->save();

            session(['inter_id' => $interrogatorio->id]);
            $inter_id = $interrogatorio->id;

            //guardamos el interrogatorio en la consulta
            $consulta_id = session('consulta_id');
            $consulta = Consulta::find($consulta_id);
            $consulta->interrogatorio_id = $interrogatorio->id;
            $consulta->save();

            //guardamos el interrogatorio AS
            $interrogatorioaparato = new Interrogatorioaparato;
            $interrogatorioaparato->signosYsintomas = $request->signos;
            $interrogatorioaparato->aparatoCardiovascular = $request->cardiovascular;
            $interrogatorioaparato->aparatoRespiratorio = $request->respiratorio;
            $interrogatorioaparato->aparatoDigestivo = $request->digestivo;
            $interrogatorioaparato->sistemaNefro = $request->nefro;
            $interrogatorioaparato->sistemaEndocrino = $request->endocrino;
            $interrogatorioaparato->sistemaHemato = $request->hematopoyetico;
            $interrogatorioaparato->sistemaNervioso = $request->nervioso;
            $interrogatorioaparato->sistemaMusculoEsqueletico = $request->musculo;
            $interrogatorioaparato->pielYtegumentos = $request->piel;
            $interrogatorioaparato->organosSentidos = $request->sentidos;
            $interrogatorioaparato->esferaPsiquica = $request->psiquica;

            $result = $interrogatorioaparato->save();

            //guardamos aparatos y sistemas en el interrogatorio
            $inter = interrogatorio::find($inter_id);
            $inter->interAS_id = $interrogatorioaparato->id;
            $inter->save();

            if($result !== false){
                session(['interAS_id' => $interrogatorioaparato->id]); //se guarda el id de los AS para ser usado en actualizar si se llega a recargar la pagina 
                return response()->json(['msg' => 'Interrogatorio Aparatos y Sistemas guardados exitosamente!'], 200);
            }else{
                return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
            }
        }
    }

    function updateaparatos(Request $request){
        $interAS_id = session('interAS_id');
        
        //guardamos el interrogatorio de AS
        $interrogatorioaparato = Interrogatorioaparato::find($interAS_id);
        $interrogatorioaparato->signosYsintomas = $request->signos;
        $interrogatorioaparato->aparatoCardiovascular = $request->cardiovascular;
        $interrogatorioaparato->aparatoRespiratorio = $request->respiratorio;
        $interrogatorioaparato->aparatoDigestivo = $request->digestivo;
        $interrogatorioaparato->sistemaNefro = $request->nefro;
        $interrogatorioaparato->sistemaEndocrino = $request->endocrino;
        $interrogatorioaparato->sistemaHemato = $request->hematopoyetico;
        $interrogatorioaparato->sistemaNervioso = $request->nervioso;
        $interrogatorioaparato->sistemaMusculoEsqueletico = $request->musculo;
        $interrogatorioaparato->pielYtegumentos = $request->piel;
        $interrogatorioaparato->organosSentidos = $request->sentidos;
        $interrogatorioaparato->esferaPsiquica = $request->psiquica;

        $result = $interrogatorioaparato->save();

        if($result !== false){
            return response()->json(['msg' => 'Interrogatorio de Aparatos y Sistemas actualizado exitosamente!'], 200);
        }else{
            return response()->json(['errormsg' => 'Ocurrio un error al guardar los datos. Intentalo más tarde.'], 401);
        }
    }
}
