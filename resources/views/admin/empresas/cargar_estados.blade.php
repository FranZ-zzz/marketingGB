<select name="departamento" id="" class="form-control">
    @foreach($estados as $estado)
        <option value="{{$estado->name}}">{{$estado->name}}</option>
    @endforeach
</select>