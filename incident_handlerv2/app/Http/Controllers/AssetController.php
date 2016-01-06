<?php

namespace App\Http\Controllers;

use Models\IncidentManager\Asset\Asset;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AssetController extends Controller
{
    /**
     * Método que permite, a partir de los datos de un request, buscar en la tabla Asset un elemento
     * que ya tenga definida la IPV4. Si no existe crea uno nuevo y devuelve el Asset
     *
     * @param $ipv4
     * @param $ipv6
     * @return Asset El asset encontrado o creado
     */
    public static function saveUpdate($ipv4, $ipv6)
    {
        $asset = Asset::whereIpv4(trim($ipv4))->first();

        if ($asset == null) {
            $asset = new Asset();
        }

        $asset->ipv4 = trim($ipv4);
        $asset->ipv6 = trim($ipv6);
        $asset->save();

        return $asset;
    }
}
