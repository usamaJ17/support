{{-- {!! Form::open(['route' => ['question.destroy', $id], 'method' => 'delete', 'id'=>"question_form"]) !!}
<div class='btn-group'>
    <a href="{{ route('question.show', $id) }}" class='btn btn-success'>
       <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('question.edit', $id) }}" class='btn btn-info'>
       <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger',
        'onclick' => "return confirm('Are you sure?')",
        'id'=>'question_submit'
    ]) !!}
</div>
{!! Form::close() !!} --}}

<div class='btn-group'>
    <input type="hidden" name="id" value="{{$id}}">
    <a href="{{ route('question.show', $id) }}" class='btn btn-success'>
        <i class="fa fa-eye"></i>
     </a>
     <a href="{{ route('question.edit', $id) }}" class='btn btn-info'>
        <i class="fa fa-edit"></i>
     </a>
    <button type="button" data-toggle="tooltip" title="change status" onclick="deleteQuestion(this.id)" id="{{$id}}" class='btn btn-danger'>
        <i class="fas fa-trash"></i>
    </button>
</div>