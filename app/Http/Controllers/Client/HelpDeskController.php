<?php

namespace NpTS\Http\Controllers\Client;

use Illuminate\Http\Request;
use NpTS\Http\Requests;
use NpTS\Http\Controllers\Controller;
use NpTS\Domain\HelpDesk\Repositories\Contracts\QuestionRepositoryContract;
use Illuminate\Auth\Guard;

class HelpDeskController extends Controller
{
    private $questionRepository;
    private $guard;
    public function __construct(QuestionRepositoryContract $questionRepository , Guard $guard)
    {
        parent::__construct();
        $this->questionRepository = $questionRepository;
        $this->guard = $guard;
        \Carbon\Carbon::setLocale('pt_BR');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Client.HelpDesk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Client.HelpDesk.create');
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAnswer($id , Request $request)
    {
        $this->validate($request,
            ['comment' => ['required','min:3']],
            ['comment.required' => 'Por favor insira uma resposta!',
            'comment.min' => "A resposta deve conter pelomenos 3 digitos."]);

        $question = $this->questionRepository->find($id);
        if ($question && $question->user_id == $this->guard->user()->id)
        {
            $question->answers()->create([
                'user_id' => $this->guard->user()->id,
                'body'    => $request->only(['comment'])['comment']
            ]);
            return redirect()->route('account.help.show',['id' => $id]);
        }

        return abort(403);
    }

    /**
     * Display an question made by the user...
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $question = $this->questionRepository->find($id);
        if($question && $question->user_id == $this->guard->user()->id)
        {
            return view('Client.HelpDesk.show', compact('question'));
        }
        return abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
