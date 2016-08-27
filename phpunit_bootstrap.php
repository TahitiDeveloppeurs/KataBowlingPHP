<?php

function displayError( $errno, $errstr, $errfile, $errline )
{
	if( $errno === E_STRICT )
	{
		return;
	}

	$stopExecution = false;

	switch( $errno )
	{
		case E_PARSE:
		case E_ERROR:
		case E_CORE_ERROR:
		case E_COMPILE_ERROR:
		case E_USER_ERROR:
			$typeError = "FATALE";
			$stopExecution = true;
			break;

		case E_WARNING:
		case E_USER_WARNING:
		case E_COMPILE_WARNING:
		case E_RECOVERABLE_ERROR:
			$typeError = "WARNING";
			break;

		case E_NOTICE:
		case E_USER_NOTICE:
			$typeError = "NOTICE";
			break;

		default:
			$typeError = "INCONNUE";
			break;
	}

	$description = "\n$typeError $errstr\n";
	$description .= "Erreur $typeError sur la ligne $errline dans le fichier $errfile:$errline\n";

	echo $description;
	debug_print_backtrace();

	if( $stopExecution )
	{
		die();
	}

	$executeInternalPHPErrorHandlerReturnValue = false;

	return !$executeInternalPHPErrorHandlerReturnValue;
}

function captureException( Exception $exception )
{
	displayError( $exception->getCode(), $exception->getMessage(), $exception->getFile(), $exception->getLine() );
}

function captureShutdown()
{
	$error = error_get_last();
	if( $error )
	{
		displayError( $error['type'], $error['message'], $error['file'], $error['line'] );
	}
	else
	{
		return true;
	}
}

error_reporting( E_ALL );
set_error_handler( 'displayError' );
set_exception_handler( 'captureException' );
register_shutdown_function( 'captureShutdown' );
