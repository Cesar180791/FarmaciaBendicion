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
 * @property string $fecha_carga
 * @property string $total_carga
 * @property int $total_item_carga
 * @property string $lote_carga
 * @property string $descripcion_lote_carga
 * @property string $vencimiento_lote_carga
 * @property int $users_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereDescripcionLoteCarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereFechaCarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereLoteCarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereTotalCarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereTotalItemCarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereUsersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cargas whereVencimientoLoteCarga($value)
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
 * App\Models\Detalle_cargas
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas query()
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Detalle_cargas whereUpdatedAt($value)
 */
	class Detalle_cargas extends \Eloquent {}
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
 * @property string $price
 * @property string $iva_price
 * @property string $final_price
 * @property int $sub_category_id
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
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFinalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFinalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIvaCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIvaPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereLaboratory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNumeroRegistro($value)
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores query()
 * @method static \Illuminate\Database\Eloquent\Builder|Proveedores whereCreatedAt($value)
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
 * @property int $stocks_id
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
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail wherePurchasesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereStocksId($value)
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
 * @property int $stocks_id
 * @property int $sale_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereStocksId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetails whereUpdatedAt($value)
 */
	class SaleDetails extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Shop
 *
 * @property int $id
 * @property string $nameShop
 * @property string $addressShop
 * @property int $phoneShop
 * @property string $codeShop
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop query()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereAddressShop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereCodeShop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereNameShop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop wherePhoneShop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereUpdatedAt($value)
 */
	class Shop extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Stock
 *
 * @property int $id
 * @property int $products_id
 * @property int $shops_id
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereProductsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereShopsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereUpdatedAt($value)
 */
	class Stock extends \Eloquent {}
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
 * App\Models\SubProducts
 *
 * @property int $id
 * @property string $name_products
 * @property int $products_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SubProducts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubProducts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubProducts query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubProducts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubProducts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubProducts whereNameProducts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubProducts whereProductsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubProducts whereUpdatedAt($value)
 */
	class SubProducts extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string $email
 * @property string $profile
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $image
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
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

