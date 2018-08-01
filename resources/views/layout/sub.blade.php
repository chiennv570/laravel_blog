@extends('layout.master')

@section('title', 'sub template')

@section('sidebar')
    @parent
    <p>Day la sidebar sub</p>
@stop
@section('content')
    Day la trang sub
@endsection

<br/>
<?php $diem = 9; ?>
@if ($diem <=5 )
    Hoc sinh trung binh
@elseif($diem > 5 && $diem <= 7)
    Hoc sinh kha
@else
    Hoc sinh gioi
@endif

<?php $chaoban = "<strong>Chien</strong>"; ?>
{{ $chaoban }}
<br/>
{!! $chaoban !!}

<br/>
{{--{{ isset($diemm) ? $diem : 'Khong ton tai bien diem' }}--}}

{{ $diem or 'Khong ton tai bien diem' }}