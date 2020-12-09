<?php
namespace App\Http\Controllers;
use App\Http\Requests\CreateTodoRequest;
use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TodoController extends Controller
{
    // ページネーションの件数
    private const PAGE_SIZE = 5;
    /**
     * Display a listing of the resource.
     * Todo一覧を取得
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo_list = Auth::user()->todos()->orderBy('due_date', 'asc')->paginate(self::PAGE_SIZE);
        return view('todo/index', compact('todo_list'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTodoRequest $request)
    {
        $todo = new Todo();
        $todo->title = $request->title;
        $todo->due_date = $request->due_date;
        $todo->status = Todo::STATUS_NOT_YET;
        Auth::user()->todos()->save($todo);
        return redirect()->to('/todo');
    }
    /**
     * Display the specified resource.
     * Todo単体を取得
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $todo = Auth::user()->todos()->findOrFail($id);
        return view('todo/show', compact('todo'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Auth::user()->todos()->findOrFail($id);
        return view('todo/edit', compact('todo'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTodoRequest $request, $id)
    {
        $todo = Auth::user()->todos()->findOrFail($id);
        $todo->title = $request->title;
        $todo->due_date = $request->due_date;
        $todo->status = $request->status;
        $todo->save();

        return redirect()->to('/todo/' . $todo->id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Auth::user()->todos()->findOrFail($id);
        $todo->delete();
        return redirect()->to('/todo');
    }
}