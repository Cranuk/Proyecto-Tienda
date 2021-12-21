<?php

function cargar_controlador($clase){
	include 'controlador/' . $clase . '.php';
}

spl_autoload_register('cargar_controlador');