<?php

namespace ATran\Translate;

use Illuminate\Http\Request;

use ATran;

class PlayWithAPIController 
{
  public function detectText(Request $request){
        $result = ATran::detectTextInformation($request->text);
        if (($request->ajax() && !$request->pjax()) || $request->wantsJson() || $request->js) {
            return response()->json($result,200);
        } else {
            return $result;
        }
    }

  public function transliterateText(Request $request){
        $result = ATran::transliterateTextInformation($request->text,$request->language,$request->fromScript,$request->toScript);
        if (($request->ajax() && !$request->pjax()) || $request->wantsJson() || $request->js) {
            return response()->json($result,200);
        } else {
            return $result;
        }
    }

    public function translateText(Request $request){
        $result = ATran::translateText($request->text,$request->to);
        if (($request->ajax() && !$request->pjax()) || $request->wantsJson() || $request->js) {
            return response()->json($result,200);
        } else {
            return $result;
        }
    }

    public function transliterationsAvailable(Request $request){
        $result = ATran::transliterationsAvailable();
        if (($request->ajax() && !$request->pjax()) || $request->wantsJson() || $request->js) {
            return response()->json($result,200);
        } else {
            return $result;
        }
    }

    public function translationAvailable(Request $request){
        $result = ATran::translationsAvailable();
        if (($request->ajax() && !$request->pjax()) || $request->wantsJson() || $request->js) {
            return response()->json($result,200);
        } else {
            return $result;
        }
    }
}
