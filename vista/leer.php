<?php

require 'modelo/conexion.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

$nombre_archivo = 'Alumnos.xlsx';
$documento = IOFactory::load($nombre_archivo);

$totalHojas = $documento->getSheetCount();

for ($indiceHoja = 0; $indiceHoja < $totalHojas; $indiceHoja++) {
  $hojaActual = $documento->getSheet($indiceHoja);
  $numeroFilas = $hojaActual->getHighestDataRow();
  $letra = $hojaActual->getHighestColumn();

  $numeroLetra = Coordinate::columnIndexFromString($letra);

  for ($indiceFila = 1; $indiceFila <= $numeroFilas; $indiceFila++) {
    for ($indiceColumna = 1; $indiceColumna <= $numeroLetra; $indiceColumna++) {
      $sql = "INSERT INTO alumnos (matricula, nombre, email, telefono, anio, seccion) VALUES ()";
      $valor = $hojaActual->getCellByColumnAndRow($indiceColumna, $indiceFila);
      echo $valor . ' ';
    }
    echo '<br/>';
  }
}
?>