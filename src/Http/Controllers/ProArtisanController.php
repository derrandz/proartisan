<?php

namespace Hamzaouaghad\ProArtisan\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Response;
use Artisan;
use Session;

    /*
    |-------------------------------------
    |
    |       ProArtisan Controller
    |
    |-------------------------------------
    */
    
class ProArtisanController extends Controller
{

	/**
	*
	* A GET method that returns the appropriate view
	*
	*@return view
	*/
	public function InsertCommands()
	{
		return view('proartisan::proartisan.insert');
	}



	/**
	*
	* A GET method that executes the received artisan commands
	* and returns the output
	*
	*@return string
	*/
	public function ExecuteCommands()
	{	
		$command   = Input::get('command');
		$arguments =  !( (Input::get('arguments') ) == "") ? Input::get('arguments') : null;
		$status    = '';

		if( $this->isNotNull($arguments) )
		{
			$arguments = $this->makeArgsArray($arguments);
		}

		if( !($status = $this->callArtisan($command, $arguments) ) )
		{
			$this->flash('warning', 'Please enter a valid artisan command '.$status);
			return Response::json("Failure", 400);
		}

		$this->flash('notice', $status );
		return Response::json("success", 200);
	}



	/*
	 |------------------------------------------------
	 | Private methods
	 |------------------------------------------------
	 | 
	 |\ These are helper methods to make some work easy. /
	 |
	 |
	 */


	/**
	*
	* Returns true if the param is not null.
	*
	*@param mixed
	*@return bool
	*/
    private function isNotNull($smth)
    {
        return !is_null($smth);
    }


    /**
     * Executes the artisan command and returns the output.
     *
	 *@param string
     *@return string
     */
    private function callArtisan($command, $arguments = null)
    {
        if($this->isNotNull($command))
        {
            if($this->isNotNull($arguments))
            {
                Artisan::call($command, $arguments);
                return Artisan::output();
            }

            Artisan::call($command, array());
           return Artisan::output();
            
        }
        
        return false;
    }


    /**
     * Takes in argument a string in the form of '--argument=value'
     * and returns an associative array in the form '['--argument' => value]'
     *
     *@param string
     *@return array
     */
    private function makeArgsArray($string)
    {
        $args   = array();
        $values = array();

        $returnArray = array();

        $splitString = explode(" ", $string);

        if(count($splitString) == 1)
        {
            $splitString = explode("=", $splitString[0]);

            if(count($splitString) == 1)
            {
                return array($splitString[0]);
            }
            else
            {
                return array($splitString[0] => $splitString[1] );
            }
        }
        else
        {
            foreach($splitString as $arg)
            {
                $arg = explode('=', $arg);
                $returnArray[$arg[0]] = $arg[1];
            }

            return $returnArray;
        }

        return false;
    }

    /**
     * Takes in two params, the first the array of keys, and the second an array of values
     * to return an associative array of both.
     *
     *@param array
     *@param array
     *@return array
     */
    private function makeAssArray($array1, $array2)
    {
        $returnArray = array();

        $i = 0;

        foreach($array1 as $array2)
        {
            $returnArray[$array1] = $array2[$i];
            $i++;
        }

        return $returnArray;
    }


    /**
     * Generates a flash message with the bootstrap styling conventions
     *
     *@param $type : string
     *@param $content : string
     *@return void
     */
    private function flash($type, $content)
    {
        $type_html_class = '';

            Session::flash('flash_message', $content);

            switch($type)
            {
                case "success" : $type_html_class = 'alert-success';
                break;
                
                case "notice" : $type_html_class = 'alert-info';
                break;

                case "danger" : $type_html_class = 'alert-danger';
                break;

                case "warning" : $type_html_class = 'alert-warning';
                break;

                case "primary" : $type_html_class = 'alert-primary';
                break;

                default:
                    $type_html_class = "text-info";
                    break;
            }

            Session::flash("flash_type", $type_html_class);

    }
}
