@if($contentlist)
@foreach($contentlist as $list)
<option value="{{$list['ID']}}">{{$list['title']}}</option>
@endforeach
@else
<option><h2>No Data Found!</h2></option>
@endif