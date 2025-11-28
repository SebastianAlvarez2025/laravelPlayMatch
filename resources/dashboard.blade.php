@extends('welcome')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- HEADER -->
    <div class="dashboard-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold">¡Bienvenido, {{ session('user')['nombre'] }}! </h1>
                <p class="lead text-muted mb-0">Sistema de Gestión Deportiva PlayMatch</p>
            </div>
            <div class="col-md-4 text-end">
                <div class="bg-primary text-white rounded-pill px-4 py-2 d-inline-block">
                    <i class="fas fa-user me-2"></i>
                    {{ session('user')['correo'] }}
                </div>
            </div>
        </div>
    </div>

    <!-- ESTADÍSTICAS -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card">
                <div class="stats-number">12</div>
                <div class="stats-title">Equipos Activos</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card" style="border-left-color: #28a745;">
                <div class="stats-number">8</div>
                <div class="stats-title">Torneos Activos</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card" style="border-left-color: #ffc107;">
                <div class="stats-number">45</div>
                <div class="stats-title">Jugadores</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card" style="border-left-color: #dc3545;">
                <div class="stats-number">15</div>
                <div class="stats-title">Partidos Hoy</div>
            </div>
        </div>
    </div>

    <!-- ACCESO RÁPIDO -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-rocket me-2"></i>Acceso Rápido</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            <a href="{{ route('equipos.index') }}" class="btn btn-outline-primary btn-lg w-100 py-3">
                                <i class="fas fa-users fa-2x mb-2"></i><br>
                                Equipos
                            </a>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <a href="{{ route('torneos.index') }}" class="btn btn-outline-success btn-lg w-100 py-3">
                                <i class="fas fa-trophy fa-2x mb-2"></i><br>
                                Torneos
                            </a>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <a href="{{ route('jugadores.index') }}" class="btn btn-outline-warning btn-lg w-100 py-3">
                                <i class="fas fa-user fa-2x mb-2"></i><br>
                                Jugadores
                            </a>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <a href="{{ route('encuentros.index') }}" class="btn btn-outline-info btn-lg w-100 py-3">
                                <i class="fas fa-futbol fa-2x mb-2"></i><br>
                                Encuentros
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.dashboard-header {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}
.stats-card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    text-align: center;
    transition: transform 0.3s;
    border-left: 4px solid #007bff;
}
.stats-card:hover {
    transform: translateY(-5px);
}
.stats-number {
    font-size: 2.5rem;
    font-weight: bold;
    color: #007bff;
}
.stats-title {
    color: #6c757d;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}
</style>
@endsection