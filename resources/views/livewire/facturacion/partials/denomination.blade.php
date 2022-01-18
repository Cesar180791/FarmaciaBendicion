<div class="row mt-2">
	<div class="col-sm-12">
		<div class="connect-sorting">
			<p class="text-center mb-2">Denominaciones</p>
			<div class="container">
				<div class="row">
					@foreach($denominations as $d)
					<div class="col-sm mt-2">
						<button wire:click.prevent="Acash({{$d->value}})" class="btn btn-dark btn-block den">
							{{ $d->value > 0 ? '$'. number_format($d->value,2, '.','') : 'Exacto' }}
						</button>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>