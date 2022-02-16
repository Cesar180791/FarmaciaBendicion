@include('common.modalHead')
<div class="row">
    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Nombre</b></p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-user"></i>
                </span>
            </div>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="Ingrese Nombre del usuario">
        </div>
        @error('name') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>
    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Teléfono</b></p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-phone"></i>
                </span>
            </div>
            <input type="text" wire:model.lazy="phone" class="form-control" placeholder="Ingrese teléfono del usuario">
        </div>
        @error('phone') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>
    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Dirección</b></p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-map-signs"></i>
                </span>
            </div>
            <input type="text" wire:model.lazy="address" class="form-control" placeholder="Ingrese dirección del usuario">
        </div>
        @error('address') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>
    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Dui</b></p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-address-card"></i>
                </span>
            </div>
            <input type="text" wire:model.lazy="dui" class="form-control" placeholder="Ingrese DUI del usuario">
        </div>
        @error('dui') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>
    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Correo</b></p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-envelope"></i>
                </span>
            </div>
            <input type="email" wire:model.lazy="email" class="form-control" placeholder="Ingrese correo del usuario">
        </div>
        @error('email') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Estado</b></p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-toggle-on"></i>
                </span>
            </div>
            <select wire:model.lazy="status" class="form-control">
                <option value="Seleccionar" selected>Seleccionar</option>
                <option value="Active">Active</option>
                <option value="Locked">Bloqueado</option>

            </select>
        </div>
        @error('status') <span class="text-danger er">{{ $message }}</span> @enderror

    </div>
    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Rol</b></p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-user-tag"></i>
                </span>
            </div>
            <select wire:model.lazy="profile" class="form-control">
                <option value="Seleccionar" selected>Seleccionar</option>
                @foreach($roles as $role)
                <option value="{{$role->name}}" selected>{{$role->name}}</option>
                @endforeach
            </select>
        </div>
        @error('profile') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>
    <div class="col-sm-12 col-md-6 mt-3">
        <p><b>Contraseña</b></p>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text input-gp fondoNegro text-white">
                    <i class="fas fa-unlock-alt"></i>
                </span>
            </div>
            <input type="password" wire:model.lazy="password" class="form-control">
        </div>
        @error('password') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>

</div>
@include('common.modalFooter')
