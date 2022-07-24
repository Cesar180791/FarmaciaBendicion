<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Cargas
 *
 * @property int $id
 * @property string $total_carga
 * @property int $total_item_carga
 * @property string|null $descripcion_carga
 * @property int $users_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereDescripcionCarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereTotalCarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereTotalItemCarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereUsersId($value)
 */
	class Cargas extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $imagen
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubCategory[] $subCategories
 * @property-read int|null $sub_categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Clientes
 *
 * @property int $id
 * @property string $nombre_cliente
 * @property string $telefono
 * @property string $NIT_cliente
 * @property string $NRC_cliente
 * @property string $gran_con_cliente
 * @property string $estado_cliente
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Clientes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Clientes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Clientes query()
 * @method static \Illuminate\Database\Eloquent\Builder|Clientes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clientes whereEstadoCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clientes whereGranConCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clientes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clientes whereNITCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clientes whereNRCCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clientes whereNombreCliente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clientes whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clientes whereUpdatedAt($value)
 */
	class Clientes extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string|null $NIT
 * @property string|null $NRC
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereNIT($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereNRC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 */
	class Company extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Denomination
 *
 * @property int $id
 * @property string $type
 * @property string $value
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Denomination newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Denomination newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Denomination query()
 * @method static \Illuminate\Database\Eloquent\Builder|Denomination whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denomination whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denomination whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denomination whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denomination whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Denomination whereValue($value)
 */
	class Denomination extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Descarga
 *
 * @property int $id
 * @property string $total_descarga
 * @property int $total_item_descarga
 * @property string $descripcion_descarga
 * @property int $users_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Descarga newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Descarga newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Descarga query()
 * @method static \Illuminate\Database\Eloquent\Builder|Descarga whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Descarga whereDescripcionDescarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Descarga whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Descarga whereTotalDescarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Descarga whereTotalItemDescarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Descarga whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Descarga whereUsersId($value)
 */
	class Descarga extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Detalle_cargas
 *
 * @property int $id
 * @property int $cargas_id
 * @property int $lotes_id
 * @property string $detalle_cargas_costo
 * @property string $detalle_cargas_costo_iva
 * @property string $detalle_cargas_costo_mas_iva
 * @property string $detalle_cargas_precio_caja
 * @property string $detalle_cargas_precio_mayoreo
 * @property string|null $detalle_cargas_precio_unidad
 * @property int $detalle_cargas_quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas query()
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereCargasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereDetalleCargasCosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereDetalleCargasCostoIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereDetalleCargasCostoMasIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereDetalleCargasPrecioCaja($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereDetalleCargasPrecioMayoreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereDetalleCargasPrecioUnidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereDetalleCargasQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereLotesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereUpdatedAt($value)
 */
	class Detalle_cargas extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Detalle_descargas
 *
 * @property int $id
 * @property int $descargas_id
 * @property int $lotes_id
 * @property string $detalle_descargas_costo
 * @property string $detalle_descargas_costo_iva
 * @property string $detalle_descargas_costo_mas_iva
 * @property string $detalle_descargas_precio_caja
 * @property string $detalle_descargas_precio_mayoreo
 * @property string|null $detalle_descargas_precio_unidad
 * @property int $detalle_descargas_quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas query()
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereDescargasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereDetalleDescargasCosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereDetalleDescargasCostoIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereDetalleDescargasCostoMasIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereDetalleDescargasPrecioCaja($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereDetalleDescargasPrecioMayoreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereDetalleDescargasPrecioUnidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereDetalleDescargasQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereLotesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereUpdatedAt($value)
 */
	class Detalle_descargas extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Lotes
 *
 * @property int $id
 * @property int $products_id
 * @property int $users_id
 * @property string $numero_lote
 * @property int $existencia_lote
 * @property int|null $existencia_lote_unidad
 * @property string $caducidad_lote
 * @property string $estado_lote
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Lotes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lotes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lotes query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lotes whereCaducidadLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lotes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lotes whereEstadoLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lotes whereExistenciaLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lotes whereExistenciaLoteUnidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lotes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lotes whereNumeroLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lotes whereProductsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lotes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lotes whereUsersId($value)
 */
	class Lotes extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Patient
 *
 * @property int $id
 * @property string $name
 * @property int $age
 * @property string $address
 * @property string $phone
 * @property string $DUI
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereDUI($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUpdatedAt($value)
 */
	class Patient extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PoliticasGarantias
 *
 * @property int $id
 * @property string $meses
 * @property string $concepto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticasGarantias newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticasGarantias newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticasGarantias query()
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticasGarantias whereConcepto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticasGarantias whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticasGarantias whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticasGarantias whereMeses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PoliticasGarantias whereUpdatedAt($value)
 */
	class PoliticasGarantias extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string $chemical_component
 * @property string|null $barCode
 * @property string $Numero_registro
 * @property string $laboratory
 * @property string $cost
 * @property string $iva_cost
 * @property string $final_cost
 * @property int $unidades_presentacion
 * @property string $precio_caja
 * @property string $precio_mayoreo
 * @property string|null $precio_unidad
 * @property int $sub_category_id
 * @property int $existencia_caja
 * @property int $existencia_unidad
 * @property string|null $indicaciones
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SubCategory $subCategory
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBarCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereChemicalComponent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereExistenciaCaja($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereExistenciaUnidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFinalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIndicaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIvaCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereLaboratory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNumeroRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrecioCaja($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrecioMayoreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrecioUnidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSubCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUnidadesPresentacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Proveedores
 *
 * @property int $id
 * @property string $nombre_proveedor
 * @property string $nombre_vendedor
 * @property string $telefono
 * @property string $NIT
 * @property string $NRC
 * @property string $gran_con
 * @property string $estado_proveedor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores query()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereEstadoProveedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereGranCon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereNIT($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereNRC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereNombreProveedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereNombreVendedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereUpdatedAt($value)
 */
	class Proveedores extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Purchase
 *
 * @property int $id
 * @property string $fecha_compra
 * @property string $total
 * @property int $item
 * @property string|null $descripcion_lote
 * @property string $factura
 * @property int $users_id
 * @property int $proveedores_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase query()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereDescripcionLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereFactura($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereFechaCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereProveedoresId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereUsersId($value)
 */
	class Purchase extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PurchaseDetail
 *
 * @property int $id
 * @property int $purchases_id
 * @property int $lotes_id
 * @property string $costo
 * @property string $costo_iva
 * @property string $costo_mas_iva
 * @property string $precio_venta
 * @property string $precio_venta_mayoreo
 * @property string|null $precio_venta_unidad
 * @property int $quantity
 * @property int $politicas_garantias_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereCosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereCostoIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereCostoMasIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereLotesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail wherePoliticasGarantiasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail wherePrecioVenta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail wherePrecioVentaMayoreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail wherePrecioVentaUnidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail wherePurchasesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereUpdatedAt($value)
 */
	class PurchaseDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Sale
 *
 * @property int $id
 * @property string|null $cliente_consumidor_final
 * @property string|null $direccion_consumidor_final
 * @property string|null $dui_consumidor_final
 * @property string $total
 * @property int $items
 * @property string $cash
 * @property string $change
 * @property string|null $numero_factura
 * @property string $status
 * @property int|null $clientes_id
 * @property int $tipos_transacciones_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereChange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereClienteConsumidorFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereClientesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereDireccionConsumidorFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereDuiConsumidorFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereItems($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereNumeroFactura($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTiposTransaccionesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereUserId($value)
 */
	class Sale extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SaleDetails
 *
 * @property int $id
 * @property int $lotes_id
 * @property int $sale_id
 * @property string $tipo_venta
 * @property string $costo
 * @property string $costo_iva
 * @property string $costo_mas_iva
 * @property string $precio_venta
 * @property string $iva_precio_venta
 * @property string $precio_venta_mas_iva
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereCosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereCostoIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereCostoMasIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereIvaPrecioVenta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereLotesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails wherePrecioVenta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails wherePrecioVentaMasIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereTipoVenta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereUpdatedAt($value)
 */
	class SaleDetails extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SubCategory
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategory whereUpdatedAt($value)
 */
	class SubCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TiposTransacciones
 *
 * @property int $id
 * @property string $tipo_transaccion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TiposTransacciones newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TiposTransacciones newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TiposTransacciones query()
 * @method static \Illuminate\Database\Eloquent\Builder|TiposTransacciones whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TiposTransacciones whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TiposTransacciones whereTipoTransaccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TiposTransacciones whereUpdatedAt($value)
 */
	class TiposTransacciones extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property string $dui
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $profile
 * @property string $status
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDui($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\kardexProductos
 *
 * @property int $id
 * @property int $products_id
 * @property string $concepto
 * @property int|null $cantidad_entrada
 * @property string|null $costo_unit_entrada
 * @property string|null $costo_total_entrada
 * @property int|null $cantidad_salida
 * @property string|null $costo_unit_salida
 * @property string|null $costo_total_salida
 * @property int $cantidad_existencias_ppal
 * @property int $cantidad_existencias_unitarias
 * @property string $costo_unit_existencias_ppal
 * @property string $costo_unit_existencias_unitarias
 * @property string $costo_total_existencias
 * @property int $id_transaccion
 * @property string $tipo_movimiento
 * @property int|null $sale_details_id
 * @property int|null $detalle_cargas_id
 * @property int|null $purchase_details_id
 * @property int|null $detalle_descargas_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos query()
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereCantidadEntrada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereCantidadExistenciasPpal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereCantidadExistenciasUnitarias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereCantidadSalida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereConcepto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereCostoTotalEntrada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereCostoTotalExistencias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereCostoTotalSalida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereCostoUnitEntrada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereCostoUnitExistenciasPpal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereCostoUnitExistenciasUnitarias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereCostoUnitSalida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereDetalleCargasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereDetalleDescargasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereIdTransaccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereProductsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos wherePurchaseDetailsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereSaleDetailsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereTipoMovimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|kardexProductos whereUpdatedAt($value)
 */
	class kardexProductos extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\n_facturas
 *
 * @method static \Illuminate\Database\Eloquent\Builder|n_facturas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|n_facturas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|n_facturas query()
 */
	class n_facturas extends \Eloquent {}
}

