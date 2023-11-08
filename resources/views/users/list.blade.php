<x-app-layout>

    @section('title', 'Felhasználók')

    <p class="text-center my-5 h1">Felhasználók lista</p>
    <div class="container mt-5 ">
        <a class="btn btn-primary mb-1" href="#">Új felhasználó</a>
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr class="text-center">
                    <th>id</th>
                    <th style="width: 150px;">Felhasználó neve</th>
                    <th style="width: 250px;">Email cím</th>
                    <th style="width: 150px;">Szerepkör neve</th>
                    @can('delete users')
                        <th></th>
                        <th>Engedélyek</th>
                    @else
                        <th>Engedélyek száma</th>
                    @endcan
                    @if (auth()->user()->can('delete users') ||
                            auth()->user()->can('update users'))
                        <th>Műveletek</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($usersWithRoles as $user)
                    <tr>
                        <td class="text-center">{{ $user->id }}</td>
                        <td class="ps-4"><b>{{ $user->name }}</b></td>
                        <td class="ps-4">{{ $user->email }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                                <span class="badge bg-danger me-1">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            <span class="badge bg-danger">{{ $role->permissions->count() }}</span>
                        </td>
                        @can('delete users')
                            <td>
                                @foreach ($user->roles as $role)
                                    @foreach ($role->permissions as $permission)
                                        <span class="badge bg-danger me-1">{{ $permission->name }}</span>
                                    @endforeach
                                @endforeach
                            </td>
                        @endcan
                        @if (auth()->user()->can('delete users') ||
                                auth()->user()->can('update users'))
                            <td>
                                <div class="d-flex justify-content-center">
                                    @can('update users')
                                        <a class="btn btn-sm btn-outline-primary"
                                            href="{{ route('users.edit', ['userName' => $user->name]) }}">szerkeszt</a>
                                    @endcan
                                    @can('delete users')
                                        <button type="button" class="btn btn-sm btn-outline-danger ms-1" id="deleteButton"
                                            data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                            data-user-name="{{ $user->name }}">
                                            Törlés
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

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
                var userName = button.data('user-name');
                var modal = $(this);

                // Az adatok beillesztése modal részekbe
                modal.find('.modal-title').text(userName);
                modal.find('.modal-text').text('Biztosan törölöd ezt a felhasználót?');

                // Törlés gombra kattintáskos művelet
                modal.find('.delete-button').on('click', function() {
                    window.location.href = "users/torol/" + userName;
                });
            });
        });
    </script>

</x-app-layout>
