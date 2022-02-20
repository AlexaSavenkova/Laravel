<?php

declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use App\Contracts\Parser;
use App\Http\Controllers\Controller;
use App\Jobs\NewsParsingJob;
use App\Models\Source;
use Illuminate\Http\Request;

class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function __invoke(Request $request)
    {
        $urls = $sources = Source::all();

         foreach ($urls as $url) {

           dispatch(new NewsParsingJob($url->link, $url->id));
         }

        return redirect()->route('admin.index')
                ->with('success', __('messages.admin.parser.success'));


    }
}
