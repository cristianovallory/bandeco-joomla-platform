<?php
/**
*An example JWeb application built on the Joomla Platform.
*
* To run this example, copy or soft-link this folder to your web server tree.
*
* @package Joomla.Examples
* @copyright Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
* @license GNU General Public License version 2 or later; see LICENSE
*/

// We are a valid Joomla entry point.
define('_JEXEC', 1);

// Setup the base path related constant.
define('JPATH_BASE', dirname(__FILE__));
define('JPATH_SITE', JPATH_BASE);
define('JPATH_THEMES', JPATH_BASE.'/themes');

// Increase error reporting to that any errors are displayed.
// Note, you would not use these settings in production.
error_reporting(E_ALL);
ini_set('display_errors', true);

// Bootstrap the application.
require dirname(__FILE__).'/bootstrap.php';

// Import the JWeb class from the platform.
jimport('joomla.application.web');
/**
* An example JWeb application class.
*
* @package Joomla.Examples
* @since 11.3
*/
class bandeco extends JApplicationWeb{
/**
* Overrides the parent doExecute method to run the web application.
*
* This method should include your custom code that runs the application.
*
* @return void
*
* @since 11.3
*/
protected function doExecute(){
	$url='http://www.pcasc.usp.br/restaurante.xml';
	$dias = array("segunda", "terca", "quarta", "quinta", "sexta", "sabado");

	$xml = JFactory::getXML($url, true);

	echo '<table>';
	echo '<tr>';
	echo '<th>Segunda-Feira</th>';
	echo '<th>Terça-Feira</th>';
	echo '<th>Quarta-Feira</th>';
	echo '<th>Quinta-Feira</th>';
	echo '<th>Sexta-Feira</th>';
	echo '<th>Sábado</th>';
	echo '</tr>';	
 	for($i=0; $i<count($dias); $i++){
		if($i==0){
			echo '<tr><td>'.$xml->$dias[$i]->almoco->salada.'<br />';
			echo $xml->$dias[$i]->almoco->principal.'<br />';
			echo $xml->$dias[$i]->almoco->acompanhamento.'<br />';
			echo $xml->$dias[$i]->almoco->sobremesa.'</td>';
		}else if($i==count($dias)-1){
			echo '<td>'.$xml->$dias[$i]->almoco->salada.'<br />';
 			echo $xml->$dias[$i]->almoco->principal.'<br />';
			echo $xml->$dias[$i]->almoco->acompanhamento.'<br />';
			echo $xml->$dias[$i]->almoco->sobremesa.'</td></tr>';
		}else{
			echo '<td>'.$xml->$dias[$i]->almoco->salada.'<br />';
 			echo $xml->$dias[$i]->almoco->principal.'<br />';
			echo $xml->$dias[$i]->almoco->acompanhamento.'<br />';
			echo $xml->$dias[$i]->almoco->sobremesa.'</td>';
		}
	}
	echo '</table>';
	echo '<br />';
	echo '<table>';
	echo '<tr>';
	echo '<th>'.$xml->$dias[0]->data.'</th>';
	echo '<th>'.$xml->$dias[1]->data.'</th>';
	echo '<th>'.$xml->$dias[2]->data.'</th>';
	echo '<th>'.$xml->$dias[3]->data.'</th>';
	echo '<th>'.$xml->$dias[4]->data.'</th>';
	echo '<th>'.$xml->$dias[5]->data.'</th>';
	echo '</tr>';	
 	for($i=0; $i<count($dias); $i++){
		if($i==0){
			echo '<tr><td>'.$xml->$dias[$i]->jantar->salada.'<br />';
			echo $xml->$dias[$i]->jantar->principal.'<br />';
			echo $xml->$dias[$i]->jantar->acompanhamento.'<br />';
			echo $xml->$dias[$i]->jantar->sobremesa.'</td>';
		}else if($i==count($dias)-1){
			echo '<td>Vai passar fome!</td></tr>';
		}else{
			echo '<td>'.$xml->$dias[$i]->jantar->salada.'<br />';
 			echo $xml->$dias[$i]->jantar->principal.'<br />';
			echo $xml->$dias[$i]->jantar->acompanhamento.'<br />';
			echo $xml->$dias[$i]->jantar->sobremesa.'</td>';
		}
	}
	echo '</table>';

}
public function getTemplate(){
	return $this->get('theme');
}

}

// Instantiate the application.
$application = JApplicationWeb::getInstance('bandeco');

// Initialise the application.
$application->initialise();

// Store the application.
JFactory::$application = $application;

// Execute the application.
$application->execute();
