<div wire:loading.delay.class="opacity-50" wire:target="store">
    <form wire:submit.prevent="store">
        <div class="form-group">
            <x-input label="Raison(s)" type="textarea" wire:model.defer="message" name="message" rows="4" required/>
            <div class="mt-4 text-end">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-dark">Signaler</button>
            </div>
        </div>
    </form>
</div>
