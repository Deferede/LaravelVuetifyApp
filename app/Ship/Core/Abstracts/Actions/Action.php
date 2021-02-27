<?php


namespace App\Ship\Core\Abstracts\Actions;


use Illuminate\Http\Request;

abstract class Action
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
