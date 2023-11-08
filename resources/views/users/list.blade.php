<x-app-layout>

    @section('title', 'Felhasználók')

    <p class="text-center my-5 h1">Felhasználók lista</p>
    <div class="container mt-5 ">
        <a class="btn btn-primary mb-1" href="#">Új felhasználó</a>
        @can('delete users')
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>id</th>
                        <th>Név</th>
                        <th>Email </th>
                        <th>Jogosultság</th>
                        <th>Engedély</th>
                        <th>Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usersWithRoles as $user)
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
                                    <a class="btn btn-sm btn-outline-primary" href="#">szerkeszt</a>
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
        @else
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>id</th>
                        <th>Név</th>
                        <th>Email </th>
                        <th class="text-center">Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usersWithRoles as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-sm btn-outline-success" href="#">szerkeszt</a>
                                    {{-- <form action="#" method="GET">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-danger ms-1" type="submit">Törlés</button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endcan


    </div>
</x-app-layout>
