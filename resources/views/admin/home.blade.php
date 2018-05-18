@extends('layouts.app')
@section('content')
    <div class="col-md-9">
        <div class="jim-content">
            <h3 class="page-header">Monthly Activity
            </h3>
            <div class="chart">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        @include('sidebar.sidebar')
    </div>
@endsection

@section('js')
@include('script.chart')
<script>

</script>
@endsection

