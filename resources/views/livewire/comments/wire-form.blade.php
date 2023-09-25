<div wire:loading.delay.class="opacity-50" wire:target="save,store">
    <form wire:submit.prevent="{{ $action }}" style="max-width: 50%;">
        <div class="form-group">
            <x-input :label="$label" type="textarea" name="message" wire:model.defer="message" rows="4" required/>
            <button class="btn btn-secondary mt-2" type="button" wire:click="{{ $cancelAction }}">Annuler</button>
            <button type="submit" class="btn btn-primary mt-2">@if($isEdit) Modifier @else Répondre @endif</button>
        </div>
    </form>
</div>
