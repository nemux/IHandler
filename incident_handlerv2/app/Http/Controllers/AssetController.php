<?php

namespace App\Http\Controllers;

use App\Models\Asset\Asset;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AssetController extends Controller
{
    /**
     * Método que permite, a partir de los datos de un request, buscar en la tabla Asset un elemento
     * que ya tenga definida la IPV4. Si no existe crea uno nuevo y devuelve el Asset
     *
     * @param Request $request
     * @return Asset El asset encontrado o creado
     */
    public static function saveUpdate(Request $request)
    {
        $asset = Asset::whereIpv4(trim($request->get('ipv4')))->first();

        if ($asset == null) {
            $asset = new Asset();
        }

        $asset->ipv4 = trim($request->get('ipv4'));
        $asset->ipv6 = trim($request->get('ipv6'));
        $asset->save();

        return $asset;
    }
}
