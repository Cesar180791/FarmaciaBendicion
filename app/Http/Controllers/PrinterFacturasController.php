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

class PrinterFacturasController extends Controller
{
    public $new='';


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




    //imprimir factura consumidor final

    public function facturaConsumidorFinal($id)
    {
        
        $nombre_impresora = "EPSON"; //impresora a utilizar
        $connector = new WindowsPrintConnector($nombre_impresora); //nombre de la impresora donde se conectara
        $printer  = new Printer($connector);

        //obtener info

        $venta = Sale::find($id);

       // $detalle = [];

        $detalle = SaleDetails::join('lotes as l','l.id','sale_details.lotes_id')
                                ->join('products as p', 'p.id','l.products_id')
                                ->select('l.products_id', 'sale_details.precio_venta_mas_iva','sale_details.quantity as cantidad','p.name')
                                ->where('sale_details.sale_id',$id)
                                ->get();

                                
    
        //dd($ventaAgravada);
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer -> setEmphasis(true);

        $printer -> setEmphasis(true);
        $printer -> setLineSpacing(22.5);
        $printer -> setFont ( Printer :: FONT_B );
        //9 saltos de linea
        $printer -> text("\n\n\n\n\n\n\n\n\n");
        //9 espacios
        $printer -> text("         ");
        $printer -> text($this->addSpaces($venta->cliente_consumidor_final,31));
        //8 espacios
        $printer -> text("        ");
        $printer -> text($this->addSpaces($venta->dui_consumidor_final,9));
        //5 espacios
        $printer -> text("     ");
        $printer -> text($this->addSpaces(date('Y-m-d'),10));
        //1 salto de linea
        $printer -> text("\n");
        //11 espacios
        $printer -> text("           ");
        $printer -> text($this->addSpaces($venta->direccion_consumidor_final,40));
        //4 saltos
        $printer -> text("\n\n\n\n");

        ///Listar Detalle
        foreach($detalle as $d){
            
            //4 espacio
            $printer -> text("    ");

            //listar productos

            $printer -> text($this->addSpaces($d->cantidad,5));
            //1 espacio
            $printer -> text(" ");
            $printer -> text($this->addSpaces($d->name,41));
            //3 espacios
            $printer -> text("   $");
            $printer -> text($this->addSpaces(number_format($d->precio_venta_mas_iva,2),6));

            //6 espacios
            $ventaAgrabada = $d->cantidad * $d->precio_venta_mas_iva;
            $printer -> text("      $");
            $printer -> text($this->addSpaces(number_format($ventaAgrabada,2),7));
            $printer -> text("\n\n");
        }
        

       // $printer -> setLineSpacing(22);
       /* $printer -> setFont ( Printer :: FONT_B );  
        for ($i = 0; $i < 43; $i++) {
            $printer -> setLineSpacing(22);
            $printer -> text(" ABCDEFGHIJKLMNOPQRSTUVWXYZ-ABCDEFGHIJKLMNOPQRSTUVWXYZ-ABCDEFGHI-ABCDEFGHIJKL\n"); //85ESPACIOS
        }

        /*$printer -> setEmphasis(true);
        //$printer -> setLineSpacing(22);
        $printer -> setFont ( Printer :: FONT_B );
        $printer -> text("\n\n\n\n\n\n\n");
        $printer -> text($this->addSpaces($venta->cliente_consumidor_final,31));
        $printer -> text("        ");
        $printer -> text($this->addSpaces($venta->dui_consumidor_final,9));
        $printer -> text("     ");
        $printer -> text($this->addSpaces(date('Y-m-d'),10));
        $printer -> text("\n");
        $printer -> text($this->addSpaces($venta->direccion_consumidor_final,40));

        //12 saltos de linea
       /* $printer -> text("\n\n\n\n\n\n\n\n\n\n\n\n");

        //6 espacios vacios para nombre 24 espacios para dui en la misma linea 5 espacios para fecha
        $printer -> text("      cesar morales                         $venta->dui_consumidor_final     09-02-2022\n\n");
        $printer -> text("       $venta->direccion_consumidor_final\n\n\n\n\n\n"); //6 espacios vacios
        $printer -> text(" 23   Acetaminofen\n\n\n"); //6 espacios vacios
      /*
         for ($i = 0; $i < 43; $i++) {
            $printer -> setLineSpacing(22);
            $printer -> text("ABCDEFGHIJKLMNOPQRSTUVWXYZ-ABCDEFGHIJKLMNOPQRSTUVWXYZ-ABCDEFGHI\n"); //60ESPACIOS
        }


/*
                $printer -> setEmphasis(true);
        $printer -> text("Line spacing\n");
        $printer -> setEmphasis(false);
        foreach(array(16, 32, 64, 128, 255) as $spacing) {
            $printer -> setLineSpacing($spacing);
            $printer -> text("Spacing $spacing: The quick brown fox jumps over the lazy dog. The quick brown fox jumps over the lazy dog.\n");
        }
        $printer -> setLineSpacing(); // Back to default
     
        /* Stuff around with left margin 
        $printer->setEmphasis(true);
        $printer->text("Left margin\n");
        $printer->setEmphasis(false);
        $printer->text("Default left\n");
        foreach (array(1, 2, 4, 8, 16, 32, 64, 128, 256, 512) as $margin) {
            $printer->setPrintLeftMargin($margin);
            $printer->text("left margin {$margin}\n");
        }
  
        $printer->setPrintLeftMargin(0);

        $printer->setEmphasis(true);
        $printer->text("Page width\n");
        $printer->setEmphasis(false);
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $printer->text("Default width\n");
        foreach (array(512, 256, 128, 64) as $width) {
            $printer->setPrintWidth($width);
            $printer->text("page width {$width}\n");
        }*/

      /* Underline 
        for ($i = 0; $i < 25; $i++) {
            $printer -> text("************************************************************\n"); //60ESPACIOS
        }
       // $printer -> setUnderline(0); // Reset
        $printer -> cut();*/
   


        $printer->close();

        /*$printer->setJustification(Printer::JUSTIFY_CENTER);

        $printer->setTextSize(2, 2);

        $printer->text('Cajero: ' . auth()->user()->name . ' venta numero: ' . $id . "\n");

        $printer->setTextSize(1, 1);

        $printer -> text("Hello World!\n");

        $printer->feed(5);

        $printer -> close();
/*
        $printer->feed();

        $printer->pulse();

        $printer->close();*/
    }
}
