<x-app-layout>

    @section('title', 'Szerepkörök')

    <p class="text-center my-5 h1">Szerepkör lista</p>
    <div class="container mt-5 ">
        <a class="btn btn-primary mb-1" href="{{ route('roles.create') }}">Új szerepkör</a>
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr class="text-center">
                    <th>id</th>
                    <th style="width: 150px;">Szerepkör neve</th>
                    <th style="width: 150px;">Guard név </th>
                    @can('delete roles')
                        <th></th>
                        <th>Engedélyek</th>
                    @else
                        <th>Engedélyek száma</th>
                    @endcan
                    @if (auth()->user()->can('delete roles') ||
                            auth()->user()->can('update roles'))
                        <th>Műveletek</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($rolesWithPermissions as $role)
                    <tr>
                        <td class="text-center">{{ $role->id }}</td>
                        <td class="ps-4"><b>{{ $role->name }}</b></td>
                        <td class="text-center">{{ $role->guard_name }}</td>
                        <td class="text-center">
                            <span class="badge bg-danger">{{ $role->permissions->count() }}</span>
                        </td>
                        @can('delete roles')
                            <td>
                                @foreach ($role->permissions as $permission)
                                    <span class="badge bg-danger me-1">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                        @endcan
                        @if (auth()->user()->can('delete roles') ||
                                auth()->user()->can('update roles'))
                            <td>
                                <div class="d-flex justify-content-center">
                                    @can('update roles')
                                        <a class="btn btn-sm btn-outline-primary"
                                            href="{{ route('roles.edit', ['roleName' => $role->name]) }}">szerkeszt</a>
                                    @endcan

                                    @can('delete roles')
                                        <form action="#" method="GET">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-outline-danger ms-1"
                                                id="deleteButton" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                data-role-name="{{ $role->name }}">
                                                Törlés
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        {{-- <h3 class="modal-title" id="staticBackdropLabel"></h3> --}}
                    </div>
                    <div class="modal-body" id="modal-body">
                        <h5 class="modal-text"></h5>
                        <h2 class="modal-title" id="staticBackdropLabel"></h2>
                    </div>
                    <div class="modal-footer">
                        <button type="button btn-sm" class="btn btn-warning" data-bs-dismiss="modal">Mégse</button>
                        <button type="button" class="delete-button btn btn-outline-danger">Törlés</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#staticBackdrop').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var roleName = button.data('role-name');
                var modal = $(this);

                // Az adatok beillesztése modal részekbe
                modal.find('.modal-title').text(roleName);
                modal.find('.modal-text').text('Biztosan törölöd ezt a szerepkört?');

                // Törlés gombra kattintáskos művelet
                modal.find('.delete-button').on('click', function() {
                    window.location.href = "roles/torol/" + roleName;
                });
            });

        });
    </script>
</x-app-layout>
