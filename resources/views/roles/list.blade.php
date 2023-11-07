<x-app-layout>

    @section('title', 'Szerepkörök')

    <p class="text-center my-5 h1">Szerepkör lista</p>
    <div class="container mt-5 ">
        <a class="btn btn-primary mb-1" href="#">Új szerepkör</a>
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr class="text-center">
                    <th>id</th>
                    <th style="width: 150px;">Szerepkör neve</th>
                    <th style="width: 150px;">Guard név </th>
                    <th></th>
                    <th>Engedélyek</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($usersWithRoles as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                                <span class="badge bg-danger me-1">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($user->roles as $role)
                                @foreach ($role->permissions as $permission)
                                    <span class="badge bg-danger me-1">{{ $permission->name }}</span>
                                @endforeach
                            @endforeach
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-sm btn-outline-success" href="#">szerkeszt</a>
                                <form action="#" method="GET">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger ms-1" type="submit">Törlés</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach --}}

                @foreach ($rolesWithPermissions as $role)
                    <tr>
                        <td class="text-center">{{ $role->id }}</td>
                        <td class="ps-4"><b>{{ $role->name }}</b></td>
                        <td class="text-center">{{ $role->guard_name }}</td>
                        <td>
                            <span class="badge bg-danger">{{ $role->permissions->count() }}</span>
                        </td>
                        <td>
                            @foreach ($role->permissions as $permission)
                                <span class="badge bg-danger me-1">{{ $permission->name }}</span>
                            @endforeach
                        </td>

                        <td>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-sm btn-outline-success" href="#">szerkeszt</a>
                                <form action="#" method="GET">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger ms-1" type="submit">Törlés</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>


    </div>
</x-app-layout>
