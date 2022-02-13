<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector; //windows
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;                          //imprimir imagenes
use Mike42\Escpos\PrintConnectors\FilePrintConnector;  //manipular intefacez de concecion

use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\Lotes;
use App\Models\Product;
use App\Models\User;
use App\Models\Clientes;
use Carbon\Carbon;
use Luecano\NumeroALetras\NumeroALetras;

class PrinterFacturasController extends Controller
{
    public $new='', $printer;


    ///FUNCION PARA AJUSTAR ESPACIOS VACIOS
    function addSpaces($string='', $validarEspacios = 0)
    {
        if(strlen($string) <= $validarEspacios)
        {
            $spaces = $validarEspacios - strlen($string);

            for($index1 = 1; $index1 <= $spaces; $index1++)
            {
                $string = $string . ' ';
            }
        }else{
            $delimitar = strlen($string) - $validarEspacios;
            $this->new = substr($string, 0, -$delimitar);
            $string = $this->new;
        }
    
        return $string;
    }

    //FUNCION PARA SALTO DE LINEA DE TOTAL EN LETRAS
    public function saltoLineaTotalLetras($string='',$validarEspacios = 0){
        if(strlen($string) <= $validarEspacios)
        {
            $spaces = $validarEspacios - strlen($string);

            for($index1 = 1; $index1 <= $spaces; $index1++)
            {
                $string = $string . ' ';
            }
        }else{
            $cadena = wordwrap($string, $validarEspacios,"\n",TRUE);
            $string = $cadena;
        }
        return $string;
    }


    //FUNCION PARA GENERAR FACTURA CONSUMIDOR FINAL

    public function facturaConsumidorFinal($id)
    {
        
        $nombre_impresora = "EPSON"; //impresora a utilizar
        $connector = new WindowsPrintConnector($nombre_impresora); //nombre de la impresora donde se conectara
        $this->printer  = new Printer($connector);

        //obtener info

        $venta = Sale::find($id);
        $detalle = SaleDetails::join('lotes as l','l.id','sale_details.lotes_id')
                                ->join('products as p', 'p.id','l.products_id')
                                ->select('l.products_id', 'sale_details.precio_venta_mas_iva','sale_details.quantity as cantidad','p.name')
                                ->where('sale_details.sale_id',$id)
                                ->get();

        //impresion de factura consumidor final
        $this->printer->setJustification(Printer::JUSTIFY_LEFT);
        $this->printer -> setEmphasis(true);
        $this->printer -> setLineSpacing(22.5);
        $this->printer -> setFont ( Printer :: FONT_B );
        //9 saltos de linea
        $this->printer -> text("\n\n\n\n\n\n\n\n\n");
        //9 espacios nombre del cliente
        $this->printer -> text("         ");
        $this->printer -> text($this->addSpaces($venta->cliente_consumidor_final,31));
        //8 espacios dui del cliente
        $this->printer -> text("        ");
        $this->printer -> text($this->addSpaces($venta->dui_consumidor_final,9));
        //5 espacios fecha de venta
        $this->printer -> text("     ");
        $this->printer -> text($this->addSpaces(date('Y-m-d'),10));
        //1 salto de linea
        $this->printer -> text("\n");
        //11 espacios direccion del cliente
        $this->printer -> text("           ");
        $this->printer -> text($this->addSpaces($venta->direccion_consumidor_final,40));
        //4 saltos
        $this->printer -> text("\n\n\n\n");

        ///Listar Detalle
        foreach($detalle as $d){
            //4 espacio
            $this->printer -> text("    ");
            //listar cantidad
            $this->printer -> text($this->addSpaces($d->cantidad,4));
            //1 espacio nombre del producto
            $this->printer -> text(" ");
            $this->printer -> text($this->addSpaces($d->name,41));
            //3 espacios precio unitario
            $this->printer -> text("   $");
            $this->printer -> text($this->addSpaces(number_format($d->precio_venta_mas_iva,2),6));

            //6 espacios venta agravada
            $ventaAgrabada = $d->cantidad * $d->precio_venta_mas_iva;
            $this->printer -> text("      $");
            $this->printer -> text($this->addSpaces(number_format($ventaAgrabada,2),7));
            //dos saltos de linea
            $this->printer -> text("\n\n"); 
            
        }

        ///IF QUE CALCULA LOS SALTOS DE LINEA QUE DARA DESPUES DEL DETALLE DE LA FACTURA
        if(count($detalle) == 1 )
        {
            //10 saltos de linea
            $this->printer -> text("\n\n\n\n\n\n\n\n\n\n");   
            $this->total($venta->total);
        }
        if(count($detalle) == 2 )
        {
            //8 saltos de linea
            $this->printer -> text("\n\n\n\n\n\n\n\n");  
            $this->total($venta->total); 
        }
        if(count($detalle) == 3 )
        {
            //6 saltos de linea
            $this->printer -> text("\n\n\n\n\n\n"); 
            $this->total($venta->total);  
        }
        if(count($detalle) == 4 )
        {
            //4 saltos de linea
            $this->printer -> text("\n\n\n\n");   
            $this->total($venta->total);
        }
        if(count($detalle) == 5 )
        {
            //dos saltos de linea
            $this->printer -> text("\n\n");   
            $this->total($venta->total);
        }
        if(count($detalle) == 6 )
        {
            //sin salto de linea
            $this->total($venta->total);
        }
        $this->printer->close();
    }

    ///FUNCION QUE CONVIERTE EL TOTAL EN LETRAS Y IMPRIME EL PIE DE LA FACTURA
    public function total($numero){
            $formatter = new NumeroALetras();
            $total = $formatter->toInvoice($numero, 2);
            $this->printer -> text("       ");

            $this->printer -> text($this->saltoLineaTotalLetras($total,41));
            $this->printer -> text("                 $");
            $this->printer -> text($this->addSpaces(number_format($numero,2),7));
            $this->printer -> text("\n\n\n\n\n\n\n");
            $this->printer -> text("                                                                  ");
            $this->printer -> text($this->addSpaces(number_format($numero,2),7));
    }
}
