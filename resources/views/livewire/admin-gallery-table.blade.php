<div>
    <h4 class="mb-3">Imágenes Existentes</h4>

    <!-- Filter Controls -->
    <div class="row mb-3 g-2">
        <div class="col-md-6">
            <input type="text" wire:model.debounce.300ms="search" class="form-control" placeholder="Buscar por título...">
        </div>
        <div class="col-md-6">
            <select wire:model="filterByCategory" class="form-select">
                <option value="">Todas las categorías</option>
                @foreach($imageCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Miniatura</th>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th style="width: 1%; white-space: nowrap;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($galleryImages as $image)
                <tr>
                    <td>{{ $image->id }}</td>
                    <td><img src="{{ Storage::url($image->file_path) }}" alt="{{ $image->title }}" style="width: 100px; height: auto; border-radius: 5px;"></td>
                    <td title="{{ $image->title }}">{{ Str::limit($image->title, 40) }}</td>
                    <td><span class="badge bg-info">{{ $image->imageCategory->name ?? 'Sin categoría' }}</span></td>
                    <td style="white-space: nowrap;">
                        <a href="{{ route('admin.gallery.edit', $image) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('admin.gallery.destroy', $image) }}" method="POST" class="d-inline ms-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta imagen?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No hay imágenes que coincidan con la búsqueda.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 pe-5">
        {{ $galleryImages->links() }}
    </div>
</div>
