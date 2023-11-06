<x-app-layout>

    @section('title', 'Felhasználók')

    <p class="text-center my-5 h1">Felhasználók lista</p>
    <div class="container mt-5 ">
        <a class="btn btn-primary mb-1" href="#">Új felhasználó</a>
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>id</th>
                    <th>Név</th>
                    <th>Email </th>
                    <th>Role</th>
                    <th>Permission</th>
                    <th class="text-center">műveletek</th>
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
                        <td>????</td>

                        <td>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-sm btn-outline-warning" href="#">szerkeszt</a>
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
