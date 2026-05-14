@extends('menu')

@section('page_title', 'Páginas — Admin')

@push('styles')
    <link href="{{ asset('assets/libs/dataTables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/toast/toastr.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12">
                    <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Pages</div>
                    <span class="text-muted small">Editores: About Us y Servicios.</span>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                if (typeof toastr !== 'undefined') {
                                    toastr.success(@json(session('success')));
                                }
                            });
                        </script>
                    @endif

                    @if (session('error'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                if (typeof toastr !== 'undefined') {
                                    toastr.error(@json(session('error')));
                                }
                            });
                        </script>
                    @endif

                    <div class="table-responsive">
                        <table id="datatable-pages" class="table table-striped text-nowrap w-100">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Slug</th>
                                    <th class="text-center">Publicada</th>
                                    <th>Actualizada</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pages as $page)
                                    <tr>
                                        <td>{{ $page->id }}</td>
                                        <td class="fw-medium">{{ $page->name }}</td>
                                        <td><code class="user-select-all">{{ $page->slug }}</code></td>
                                        <td class="text-center" data-order="{{ $page->is_published ? '1' : '0' }}">
                                            @if ($page->is_published)
                                                <span class="badge bg-success">Sí</span>
                                            @else
                                                <span class="badge bg-secondary">No</span>
                                            @endif
                                        </td>
                                        <td data-order="{{ $page->updated_at?->timestamp ?? 0 }}">
                                            <span class="text-muted small">{{ $page->updated_at?->format('d/m/Y H:i') }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if (in_array($page->slug, ['about-us', 'services', 'our-work'], true))
                                                <a href="{{ route('pages.edit', $page) }}" class="btn btn-sm btn-info btn-wave"
                                                    title="Editar en el panel">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                            @else
                                                <span class="text-muted small" title="Sin editor en el panel">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            No hay filas en <code>pages</code>. Ejecuta <code>php artisan db:seed --class=SiteContentSeeder</code>.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/libs/toast/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dataTables/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof expandMenuAndHighlightOption === 'function') {
                expandMenuAndHighlightOption(null, 'adminPaginasListado');
            }

            if (typeof $ !== 'undefined' && $.fn.DataTable) {
                $('#datatable-pages').DataTable({
                    order: [[0, 'asc']],
                    pageLength: 10,
                    language: {
                        processing: 'Procesando...',
                        search: 'Buscar:',
                        lengthMenu: 'Mostrar _MENU_ registros',
                        info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
                        infoEmpty: 'Mostrando 0 a 0 de 0 registros',
                        infoFiltered: '(filtrado de _MAX_ registros)',
                        loadingRecords: 'Cargando...',
                        zeroRecords: 'No se encontraron resultados',
                        emptyTable: 'Ningún dato disponible en esta tabla',
                        paginate: {
                            first: '<<',
                            previous: '<',
                            next: '>',
                            last: '>>'
                        },
                        aria: {
                            sortAscending: ': orden ascendente',
                            sortDescending: ': orden descendente'
                        }
                    }
                });
            }
        });
    </script>
@endpush
