<?php

	namespace App\Http\Controllers;

	use App\Models\Menuset;
	use Illuminate\Database\Eloquent\Collection;
	use Illuminate\Http\RedirectResponse;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;

	class MenusetController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			$val = Menuset::all();
			return view('menuset', ['data' => $val]);
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			//
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request): RedirectResponse
		{
			if ($request->isMethod('post')) {
				$data = $request->post();
			}
			array_shift($data);//remove first element with token info
			$titles = $data['row']['title'];
			$links  = $data['row']['link'];
			$data   = array_combine($titles, $links);
			DB::table('menusets')->truncate();//remove all data from table in DB
			foreach ($data as $k => $v) {
				Menuset::create(['title' => $k, 'link' => $v]); //create new row in table
			}
			return redirect('home'); //go to dashboard
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  \App\Models\Menuset  $menuset
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show(Menuset $menuset)
		{
			dd('hello2');
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  \App\Models\Menuset  $menuset
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function edit(Menuset $menuset)
		{
			//
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  \App\Models\Menuset  $menuset
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, Menuset $menuset)
		{
			//
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  \App\Models\Menuset  $menuset
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(Menuset $menuset)
		{
			//
		}
	}
