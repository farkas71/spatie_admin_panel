<x-app-layout>
    @section('title', 'Szerepkörök')

    <div class="container d-flex justify-content-center mt-3">
        <div class="col-6">
            <form action="{{ route('roles.add') }}" method="POST">
                @csrf
                <legend class="text-center">Szerepkör felvétel</legend>

                <label for="role_name">Szerepkőr neve:</label>
                <input type="text" class="form-control mb-2" name="role_name" id="role_name" required>

                <label>Engedélyek:</label><br>
                <div class="form-control mb-2">
                    @foreach ($permissions as $permission)
                        <span class="badge text-bg-danger m-1">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                id="{{ $permission->id }}" class="form-check-input">
                            <label for="{{ $permission->id }}" class="form-check-label">{{ $permission->name }}</label>
                        </span>
                    @endforeach
                    <br><br>
                     <label>
                        <input type="checkbox" id="selectAllPermissions"> Összes:
                    </label>
                </div>
                <a href="javascript:history.back()" class="btn btn-sm btn-warning mt-2">Vissza</a>
                <input type="submit" name="mentes" value="MENTÉS" class="btn btn-sm btn-success mt-2">
            </form>
        </div>
    </div>

    <script>
        var selectAllCheckbox = document.getElementById('selectAllPermissions');
        var permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');

        selectAllCheckbox.addEventListener('change', function() {
            permissionCheckboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

    </script>



</x-app-layout>
