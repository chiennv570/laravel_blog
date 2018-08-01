@extends('layout.master')
@section('title', 'layout template')
@section('sidebar')
Day la sidebar layout
@stop
@section('content')
Day la trang layout
@endsection

So thu tu:
@for($i = 0; $i <=10; $i++)
    {{ $i }}
@endfor

<hr/>

<?php $i = 0; ?>
@while($i < 10)
    <?php $i++; ?>
    So thu tu: {{ $i }} </br>
@endwhile


<hr/>
<?php $arr = ['com', 'chao', 'pho']; ?>

@foreach($arr as $item)
    {{ $item }}
@endforeach