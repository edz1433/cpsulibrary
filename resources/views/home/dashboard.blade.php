@extends('layout.master_layout')

@section('body')

<div class="content">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-5 col-6">
                <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Visitors</h3>
      
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class="col-lg-7 col-6">    
                <div class="card card-secondary">
                    <div class="card-header">
                    <h3 class="card-title">Students Visited Library Most Frequently</h3>
    
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            
        </div>
    </div>
</div>
@endsection