</div>
      <div class="modal-footer">
        <button type="button" wire:click.prevent="resetUI()" class="btn fondoNegro close-btn text-white" data-dismiss="modal"><b>Cerrar</b></button>
        @if($selected_id < 1)
        <button type="button" wire:click.prevent="Store()" class="btn fondoNegro close-modal text-white"><b>Guardar</b></button>
        @else
        <button type="button" wire:click.prevent="Update()" class="btn fondoNegro close-modal text-white"><b>Actualizar</b></button>
        @endif
      </div>
    </div>
  </div>
</div>