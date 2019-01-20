<?php

namespace AzureTran\Translate;

use Illuminate\Http\Request;

use AzureTran;

class PlayWithAPIController 
{
  public function detectText(Request $request){
        $result = AzureTran::detectTextInformation($request->text);
        if (($request->ajax() && !$request->pjax()) || $request->wantsJson() || $request->js) {
            return response()->json($result,200);
        } else {
            return $result;
        }
    }

  public function transliterateText(Request $request){
        $result = AzureTran::transliterateTextInformation($request->text,$request->language,$request->fromScript,$request->toScript);
        if (($request->ajax() && !$request->pjax()) || $request->wantsJson() || $request->js) {
            return response()->json($result,200);
        } else {
            return $result;
        }
    }

    public function translateText(Request $request){
        $result = AzureTran::translateText($request->text,$request->to);
        if (($request->ajax() && !$request->pjax()) || $request->wantsJson() || $request->js) {
            return response()->json($result,200);
        } else {
            return $result;
        }
    }

    public function transliterationsAvailable(Request $request){
        $result = AzureTran::transliterationsAvailable();
        if (($request->ajax() && !$request->pjax()) || $request->wantsJson() || $request->js) {
            return response()->json($result,200);
        } else {
            return $result;
        }
    }

    public function translationAvailable(Request $request){
        $result = AzureTran::translationsAvailable();
        if (($request->ajax() && !$request->pjax()) || $request->wantsJson() || $request->js) {
            return response()->json($result,200);
        } else {
            return $result;
        }
    }
}
