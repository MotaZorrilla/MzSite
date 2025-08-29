@extends('layouts.admin')

@section('title', 'Gestión de Usuarios')

@section('content')
<!-- ======= Users Section ======= -->
<section id="users" class="services" data-aos="fade-up">
    <div class="container">
        <div class="section-title">
            <h2>Gestión de Usuarios</h2>
            <p>Crea nuevos usuarios y administra sus roles y grados.</p>
        </div>

        <!-- Add User Form -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <h4 class="mb-3">Agregar Nuevo Usuario</h4>
                <form action="{{ route('admin.users.store') }}" method="POST" class="p-4 border rounded">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" placeholder="Nombre Completo" required value="{{ old('name') }}">
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" required value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar Contraseña" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <select name="role" class="form-select" required>
                                <option value="">Asignar Rol...</option>
                                <option value="usuario" @if(old('role') == 'usuario') selected @endif>Usuario</option>
                                <option value="administrador" @if(old('role') == 'administrador') selected @endif>Administrador</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <select name="degree_id" class="form-select">
                                <option value="">Asignar Grado (si es Usuario)...</option>
                                @foreach ($degrees as $degree)
                                    <option value="{{ $degree->id }}" @if(old('degree_id') == $degree->id) selected @endif>{{ $degree->id }}° - {{ $degree->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-center mt-3"><button type="submit" class="btn btn-primary">Crear Usuario</button></div>
                </form>
            </div>
        </div>

        <!-- Users Management Table -->
        <div class="row">
            <div class="col-lg-12">
                @livewire('admin-users-table')
            </div>
        </div>
    </div>
</section><!-- End Users Section -->
@endsection
