<div>
    <h4 class="mb-3">Usuarios Existentes</h4>

    <!-- Filter Controls -->
    <div class="row mb-3 g-2">
        <div class="col-md-4">
            <input type="text" wire:model.debounce.300ms="search" class="form-control" placeholder="Buscar por nombre o email...">
        </div>
        <div class="col-md-4">
            <select wire:model="filterByRole" class="form-select">
                <option value="">Todos los roles</option>
                @foreach($roles as $role)
                    <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select wire:model="filterByDegree" class="form-select">
                <option value="">Todos los grados</option>
                @foreach($degrees as $degree)
                    <option value="{{ $degree->id }}">{{ $degree->id }}° - {{ $degree->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Grado</th>
                    <th style="width: 1%; white-space: nowrap;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <td>{{ $user->id }}</td>
                        <td title="{{ $user->name }}">{{ Str::limit($user->name, 25) }}</td>
                        <td title="{{ $user->email }}">{{ Str::limit($user->email, 25) }}</td>
                        <td>
                            <select name="role" class="form-select form-select-sm">
                                <option value="usuario" @if($user->role == 'usuario') selected @endif>Usuario</option>
                                <option value="administrador" @if($user->role == 'administrador') selected @endif>Administrador</option>
                            </select>
                        </td>
                        <td>
                            <select name="degree_id" class="form-select form-select-sm">
                                <option value="">N/A</option>
                                @foreach ($degrees as $degree)
                                    <option value="{{ $degree->id }}" @if($user->degree_id == $degree->id) selected @endif>{{ $degree->id }}°</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="white-space: nowrap;">
                            <button type="submit" class="btn btn-sm btn-success">Guardar</button>
                    </form>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline ms-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar a este usuario?')">Eliminar</button>
                    </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No hay usuarios que coincidan con la búsqueda.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
