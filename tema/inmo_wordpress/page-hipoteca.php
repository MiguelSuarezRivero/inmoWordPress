<?php

header('access-control-allow-origin: *');
/**
 * PHP Version of PMT in Excel.
 *
 * @param float $apr
 *   Interest rate.
 * @param integer $term
 *   Loan length in years.
 * @param float $loan
 *   The loan amount.
 *
 * @return float
 *   The monthly mortgage amount.
 */
$simbolo_moneda= $wpdb->get_var( "SELECT `simbolo` FROM `configuracion`" );

$interes=floatval($_POST['interes']);
$entrada=intval($_POST['entrada']);
$anos=intval($_POST['duracion']);
$valor=intval($_POST['valor']);

$total=$valor - $entrada;

function pmt($apr, $term, $loan) {
  $term = $term * 12;
  $apr = $apr / 1200;
  $amount = $apr * -$loan * pow((1 + $apr), $term) / (1 - pow((1 + $apr), $term));
  // return number_format($amount, 2);
  return number_format($amount, 2, ',', '.');
}

echo pmt($interes,$anos,$total) . $simbolo_moneda . '*';
?>