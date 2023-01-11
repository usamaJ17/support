@php
    $agents=App\Models\User::where('role','=','agent')->get();
@endphp
{{-- <input type="hidden" name="ticket_id" value="{{$id}}" id="ticket_val"> --}}
<select class="form-control" id="{{$id}}" name="change" onchange="change(this.value,this.id)">
    <option value="" selected disabled>Select</option>
    @foreach($agents as $agent)
        <option value="<?= $agent->id ?>"><?= $agent->name ?></option>
    @endforeach
</select>