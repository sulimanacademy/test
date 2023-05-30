<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Http;
	use Illuminate\View\View;


	class ApiController extends Controller
	{


		public function index():View
		{

			$response      = Http::get('https://api.privatbank.ua/p24api/pubinfo?&exchange&coursid=5');
			$response_data = $response->json();

			$formated_data = [];

			foreach ($response_data as $v) {
				$formated_data[$v['ccy']] = array_slice($v, 2, 2, true);

			}


			$formated_data['UAH'] = ['buy' => '1', 'sale' => '1'];

			return view('welcome', ['data' => $formated_data]);

		}


	}




	//