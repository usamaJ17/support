<div class='btn-group'>
    <input type="hidden" name="id" value="{{$id}}">
    <a href="{{ route('ticket.show', $id) }}" class='btn btn-success'>
       <i class="fa fa-eye"></i>
    </a>
    <button type="button" data-toggle="tooltip" title="change status" onclick="changeStatus(this.id)" id="{{$id}}" class='btn btn-warning'>
        <i class="fas fa-undo"></i>
     </button>
</div>