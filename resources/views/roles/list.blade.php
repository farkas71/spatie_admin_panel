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
                    @if (auth()->user()->can('delete roles') || auth()->user()->can('update roles'))
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
                        @if (auth()->user()->can('delete roles') || auth()->user()->can('update roles'))
                            <td>
                                <div class="d-flex justify-content-center">
                                    @can('update roles')
                                        <a class="btn btn-sm btn-outline-success"
                                            href="{{ route('roles.edit', ['roleName' => $role->name]) }}">szerkeszt</a>
                                    @endcan

                                    @can('delete roles')
                                        <form action="#" method="GET">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger ms-1"
                                                type="submit">Törlés</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
