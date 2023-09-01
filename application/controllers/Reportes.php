<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require 'vendor/autoload.php';

ini_set('memory_limit', '-1');


class Reportes extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->logged_in = $this->session->logged_in ? TRUE : FALSE;
		$this->load->library('layout_library');
	}

	public function index()
	{
        if( ! $this->logged_in )
        {
            redirect('account/login');
        }

        $d = array();
		$d['title'] = "Reportes";

		$data = array();
		$data['subview'] = $this->load->view('reportes/index', $d, true);
		$data['controlador'] = 'reportes';
        $data['accion'] = 'index';

		$this->layout_library->load_layout($data);
	}

	public function exportar_incidentes($fechas)
    {
        $fecha = date("d-m-Y");  
		$fileName = 'reporte_incidentes'.$fecha.'.xlsx';
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Detalle');

    	$this->load->model('incidentes_m');
        $reporte_inc = $this->incidentes_m->get_by_dates($fechas);

        //log_message("error", count($reporte_inc));
        
        if( count($reporte_inc) > 0)
        {
            //Contador de filas
            $contador = 1;
            
            //Le aplicamos ancho las columnas.
            $sheet->getColumnDimension('A')->setWidth(10);
            $sheet->getColumnDimension('B')->setWidth(20);
            $sheet->getColumnDimension('C')->setWidth(25);
            $sheet->getColumnDimension('D')->setWidth(60);
            $sheet->getColumnDimension('E')->setWidth(20);
            $sheet->getColumnDimension('F')->setWidth(40);
            $sheet->getColumnDimension('G')->setWidth(20);
            $sheet->getColumnDimension('H')->setWidth(30); //Asignado
            $sheet->getColumnDimension('I')->setWidth(20);
            $sheet->getColumnDimension('J')->setWidth(40);
            $sheet->getColumnDimension('K')->setWidth(20); //Modificado
            $sheet->getColumnDimension('L')->setWidth(70); //Comentario
            $sheet->getColumnDimension('M')->setWidth(30); //Modificado por
            $sheet->getColumnDimension('N')->setWidth(25); //Estado

            //Le aplicamos negrita a los títulos de la cabecera.
            $sheet->getStyle("A{$contador}")->getFont()->setBold(true);
            $sheet->getStyle("B{$contador}")->getFont()->setBold(true);
            $sheet->getStyle("C{$contador}")->getFont()->setBold(true);
            $sheet->getStyle("D{$contador}")->getFont()->setBold(true);
            $sheet->getStyle("E{$contador}")->getFont()->setBold(true);
            $sheet->getStyle("F{$contador}")->getFont()->setBold(true);
            $sheet->getStyle("G{$contador}")->getFont()->setBold(true);
            $sheet->getStyle("H{$contador}")->getFont()->setBold(true);
            $sheet->getStyle("I{$contador}")->getFont()->setBold(true);
            $sheet->getStyle("J{$contador}")->getFont()->setBold(true);
            $sheet->getStyle("K{$contador}")->getFont()->setBold(true);
            $sheet->getStyle("L{$contador}")->getFont()->setBold(true);
            $sheet->getStyle("M{$contador}")->getFont()->setBold(true);
            $sheet->getStyle("N{$contador}")->getFont()->setBold(true);

            //Definimos los títulos de la cabecera.
            $sheet->setCellValue("A{$contador}", 'Ticket');
            $sheet->setCellValue("B{$contador}", 'Asunto');
            $sheet->setCellValue("C{$contador}", 'Fecha creacion');
            $sheet->setCellValue("D{$contador}", 'Descripcion');
            $sheet->setCellValue("E{$contador}", 'Estado actual');
            $sheet->setCellValue("F{$contador}", 'Creado por');
            $sheet->setCellValue("G{$contador}", 'Tipo de caso');
            $sheet->setCellValue("H{$contador}", 'Asignado');
            $sheet->setCellValue("I{$contador}", 'Area');
            $sheet->setCellValue("J{$contador}", 'Categoria');
            $sheet->setCellValue("K{$contador}", 'Fecha modificacion');
            $sheet->setCellValue("L{$contador}", 'Comentario');
            $sheet->setCellValue("M{$contador}", 'Modificado por');
            $sheet->setCellValue("N{$contador}", 'Estado');

            //Definimos la data del cuerpo.        
            foreach($reporte_inc as $i)
            {
               //Incrementamos una fila más, para ir a la siguiente.
               $contador++;
               //Informacion de las filas de la consulta.
               $sheet->setCellValue("A{$contador}", $i->id);
               $sheet->setCellValue("B{$contador}", $i->asunto);
               $sheet->setCellValue("C{$contador}", $i->fecha_creacion);
               $sheet->setCellValue("D{$contador}", $i->descripcion);
               $sheet->setCellValue("E{$contador}", strtoupper($i->estado_actual));
               $sheet->setCellValue("F{$contador}", $i->creado_por);
               $sheet->setCellValue("G{$contador}", $i->tipo_caso);
               $sheet->setCellValue("H{$contador}", $i->asignado_a == '0' ? 'Sin asignar': $i->asignado_a);
               $sheet->setCellValue("I{$contador}", $i->area);
               $sheet->setCellValue("J{$contador}", $i->categoria . ' - '.$i->subcategoria);
               $sheet->setCellValue("K{$contador}", $i->modificado);
               $sheet->setCellValue("L{$contador}", $i->comentario);
               $sheet->setCellValue("M{$contador}", $i->modificado_por);
               $sheet->setCellValue("N{$contador}", $i->estado_seguimiento);
            }
            
            //$archivo = "reporte_incidentes{$id_cliente}.xls";
            

            // $writer = new Xlsx($spreadsheet);
            // $writer->save("upload/".$fileName);
            // header("Content-Type: application/vnd.ms-excel");
            // redirect(base_url()."/upload/".$fileName);

            // header('Content-Type: application/vnd.ms-excel');
            // header('Content-Disposition: attachment;filename="'.$archivo.'"');
            // header('Cache-Control: max-age=0'); //no cache
            // //header('Cache-Control: max-age=1');
            // $objWriter = PHPExcel_IOFactory::createWriter($sheet, 'Excel5');
            // // Forzamos a la descarga
            // $objWriter->save('php://output');

             

        }

        $writer = new Xlsx($spreadsheet);
        $writer->save("upload/".$fileName);
        header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/upload/".$fileName); 
        // else
        // {
        // 	$this->load->library('excel');

        //     $sheet->setActiveSheetIndex(0);
        //     $sheet->setTitle('Detalle');

        //     //Le aplicamos ancho las columnas.
        //     $sheet->getColumnDimension('A')->setWidth(40);
		// 	$sheet->setCellValue('A1', 'No se han encontrado datos');
        //     $archivo = "reporte_incidentes.xlsx";

        //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //     header('Content-Disposition: attachment;filename="'.$archivo.'"');
        //     header('Cache-Control: max-age=0'); //no cache
        //     header('Cache-Control: max-age=1');
        //     $objWriter = PHPExcel_IOFactory::createWriter($sheet, 'Excel2007');
            
        //     // Forzamos a la descarga
        //     $objWriter->save('php://output');
        // }
    }

    //Generar en excel
	function exportar_test($fi = null, $ff = null, $extension = "", $estado = "", $grupo = "", $tipo = "") 
	{
		$fecha = date("d-m-Y");  
		$fileName = 'reporte_llamadas_'.$fecha.'.xlsx';

		//$this->load->model('reportes_m');
		//$datos = $this->reportes_m->get_report($fi, $ff, $extension, $estado, $grupo, $tipo, 'array');
		
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

		$rows = 1;

		$range = 'A'.$rows.':H'.$rows;
        $sheet->setCellValue('A'.$rows, 'REPORTE DE LLAMADAS');
        $sheet->mergeCells($range);

        $rows++; 

        $fi_ = str_replace("-", "/", $fi);
        $ff_ = str_replace("-", "/", $ff);

        $sheet->setCellValue('A'.$rows, $fi_." - ".$ff_);
		$sheet->mergeCells('A'.$rows.':C'.$rows);

        $rows++;

        $sheet->setCellValue('A'.$rows, 'FECHA');
		$sheet->setCellValue('B'.$rows, 'GRUPO');
        $sheet->setCellValue('C'.$rows, 'EJECUTIVO');
        $sheet->setCellValue('D'.$rows, 'ORIGEN');
        $sheet->setCellValue('E'.$rows, 'DESTINO');
		$sheet->setCellValue('F'.$rows, 'DURACION');
        $sheet->setCellValue('G'.$rows, 'ESTADO');
        $sheet->setCellValue('H'.$rows, 'TIPO LLAMADA');

        $rows++;

        // foreach ($datos as $val)
        // {
        //     $sheet->setCellValue('A' . $rows, $val['calldate']);
        //     $sheet->setCellValue('B' . $rows, $val['grupo']);
        //     $sheet->setCellValue('C' . $rows, $val['ejecutivo']);
        //     $sheet->setCellValue('D' . $rows, $val['src']);
        //     $sheet->setCellValue('E' . $rows, $val['dst']); 
        //  	$sheet->setCellValue('F' . $rows, $val['duracion']);
        //     $sheet->setCellValue('G' . $rows, $val['estado']);

        //     $tipo_llamada = "";

        //     if($val['tipo'] == 1)
        //     {
        //     	$tipo_llamada = "SALIENTE";
        //     }
        //     else
        //     {
        //     	$tipo_llamada = "ENTRANTE";
        //     }

        //     $sheet->setCellValue('H' . $rows, $tipo_llamada);

        //     $rows++;
        // }

        //Estilos
		// $sheet->getColumnDimension('A')->setAutoSize(true);
		// $sheet->getColumnDimension('B')->setAutoSize(true);
		// $sheet->getColumnDimension('C')->setAutoSize(true);
		// $sheet->getColumnDimension('D')->setAutoSize(true);
		// $sheet->getColumnDimension('E')->setAutoSize(true);
		// $sheet->getColumnDimension('F')->setAutoSize(true);
		// $sheet->getColumnDimension('G')->setAutoSize(true);
		// $sheet->getColumnDimension('H')->setAutoSize(true);

		//----------------------------------------------------------------------------------------------------
		//PRIMERA LINEA
		//----------------------------------------------------------------------------------------------------
		//  $styleArray1 = [
		//     'font' => [ 'size' => 18 ],
		//     'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, ]
		// ];

		// $range = 'A1:H1';
        // $sheet->getStyle($range)->applyFromArray($styleArray1);
        //----------------------------------------------------------------------------------------------------

        //----------------------------------------------------------------------------------------------------
        //APLICAMOS NEGRITA A LAS 3 PRIMERAS LINEAS Y LOS TOTALES
        //----------------------------------------------------------------------------------------------------
		// $styleArray2 = [
		//     'font' => [ 'bold' => true ]
		// ];

		// $range1 = 'A1:H3';
		// //$range2 = 'A'.($rows-1).':H'.($rows-1);
        // $sheet->getStyle($range1)->applyFromArray($styleArray2);
        //$sheet->getStyle($range2)->applyFromArray($styleArray2);
        //----------------------------------------------------------------------------------------------------

        //----------------------------------------------------------------------------------------------------
        //APLICAMOS FONDO AZUL BAJO A LA TERCERA LINEA (LIDERES, ASISTEN...)
        //----------------------------------------------------------------------------------------------------
		// $styleArray3 = [
		// 	'font' => [ 'size' => 11 ],
		//      'fill' => [
		//         'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
		//         'rotation' => 90,
		//         'startColor' => [ 'argb' => 'dce6f1' ],
		// 		'endColor' => [ 'argb' => 'dce6f1' ]
		//     ]
		// ];

        // $range1 = 'A3'.':H3';
        // $sheet->getStyle($range1)->applyFromArray($styleArray3);        
        //----------------------------------------------------------------------------------------------------

        //----------------------------------------------------------------------------------------------------
        //APLICAMOS BORDES A TODO
        //----------------------------------------------------------------------------------------------------
		// $styleArray4 = [
		//     'borders' => [ 
		//     	'allBorders' => [ 'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN ]
		//      ]
		// ];

		// $range = 'A1:H'.($rows-1);
		// $sheet->getStyle($range)->applyFromArray($styleArray4);

		// $sheet->getSheetView()->setZoomScale(90);

        //$spreadsheet->freezePane('S2');
        //$spreadsheet->freezePaneByColumnAndRow(0,2);

        $writer = new Xlsx($spreadsheet);
		$writer->save("upload/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/upload/".$fileName);              
    }
}