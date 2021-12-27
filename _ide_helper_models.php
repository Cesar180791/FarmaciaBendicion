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
 * @property string $descripcion_carga
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
 * @property int $total_item_descaga
 * @property string $descripcion_Descarga
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
 * @method static \Illuminate\Database\Eloquent\Builder|Descarga whereTotalItemDescaga($value)
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
 * @property int $products_id
 * @property string $detalle_cargas_lote
 * @property string $vencimiento_lote
 * @property string $detalle_cargas_costo
 * @property string $detalle_cargas_costo_iva
 * @property string $detalle_cargas_costo_mas_iva
 * @property string $detalle_cargas_precio_venta
 * @property string $detalle_cargas_precio_iva
 * @property string $detalle_cargas_precio_mas_iva
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
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereDetalleCargasLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereDetalleCargasPrecioIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereDetalleCargasPrecioMasIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereDetalleCargasPrecioVenta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereDetalleCargasQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereProductsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereVencimientoLote($value)
 */
	class Detalle_cargas extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Detalle_descargas
 *
 * @property int $id
 * @property int $descargas_id
 * @property int $products_id
 * @property string $detalle_descargas_costo
 * @property string $detalle_descargas_costo_iva
 * @property string $detalle_descargas_costo_mas_iva
 * @property string $detalle_descargas_precio_venta
 * @property string $detalle_descargas_precio_iva
 * @property string $detalle_descargas_precio_mas_iva
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
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereDetalleDescargasPrecioIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereDetalleDescargasPrecioMasIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereDetalleDescargasPrecioVenta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereDetalleDescargasQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereProductsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_descargas whereUpdatedAt($value)
 */
	class Detalle_descargas extends \Eloquent {}
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
 * @property string $porcentaje_ganancia
 * @property string $price
 * @property string $iva_price
 * @property string $final_price
 * @property int $sub_category_id
 * @property int $existencia
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
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereExistencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFinalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFinalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIvaCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIvaPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereLaboratory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNumeroRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePorcentajeGanancia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSubCategoryId($value)
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
 * @property string $telefono
 * @property string $NIT
 * @property string $NRC
 * @property string $estado_proveedor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores query()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereEstadoProveedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereNIT($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereNRC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereNombreProveedor($value)
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
 * @property string $lote
 * @property string $descripcion_lote
 * @property string $factura
 * @property string $vencimiento
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
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereProveedoresId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereUsersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereVencimiento($value)
 */
	class Purchase extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PurchaseDetail
 *
 * @property int $id
 * @property int $purchases_id
 * @property int $products_id
 * @property string $costo
 * @property string $costo_iva
 * @property string $costo_mas_iva
 * @property string $precio_venta
 * @property string $precio_iva
 * @property string $precio_mas_iva
 * @property int $quantity
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
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail wherePrecioIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail wherePrecioMasIva($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail wherePrecioVenta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereProductsId($value)
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
 * @property string $total
 * @property int $items
 * @property string $cash
 * @property string $change
 * @property string $status
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereChange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereItems($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereStatus($value)
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
 * @property string $price
 * @property string $quantity
 * @property int $products_id
 * @property int $sale_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereProductsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereSaleId($value)
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

