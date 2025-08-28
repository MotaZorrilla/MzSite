<div>
    <h4 class="mb-3">Documentos Existentes</h4>

    <!-- Filter Controls -->
    <div class="row mb-3 g-2">
        <div class="col-md-4">
            <input type="text" wire:model.debounce.300ms="search" class="form-control" placeholder="Buscar por título o descripción...">
        </div>
        <div class="col-md-4">
            <select wire:model="filterByCategory" class="form-select">
                <option value="">Todas las categorías</option>
                @foreach($documentCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select wire:model="filterBySource" class="form-select">
                <option value="">Todas las fuentes</option>
                @foreach($sources as $source)
                    <option value="{{ $source }}">{{ $source }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Fuente</th>
                    <th>Grado Req.</th>
                    <th style="width: 1%; white-space: nowrap;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($works as $work)
                <tr>
                    <td>{{ $work->id }}</td>
                    <td title="{{ $work->title }}">{{ Str::limit($work->title, 35) }}</td>
                    <td>{{ Str::limit($work->description, 50) }}</td>
                    <td><span class="badge bg-info">{{ $work->documentCategory->name ?? 'Sin categoría' }}</span></td>
                    <td><span class="badge bg-dark">{{ $work->source }}</span></td>
                    <td><span class="badge bg-secondary">{{ $work->required_degree }}°</span></td>
                    <td style="white-space: nowrap;">
                        <a href="{{ route('admin.documents.edit', $work) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('admin.documents.destroy', $work) }}" method="POST" class="d-inline ms-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este documento?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No hay documentos que coincidan con la búsqueda.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $works->links() }}
    </div>
</div>
