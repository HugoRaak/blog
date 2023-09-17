<form wire:submit="store" style="max-width: 50%;">
    <div class="form-group">
        <x-input label="Votre réponse" type="textarea" name="message" wire:model="message" rows="4" required/>
        <button type="submit" class="btn btn-primary mt-2">Répondre</button>
        <button class="btn btn-secondary mt-2" type="button" wire:click="$parent.cancelReply()">Annuler</button>
    </div>
</form>
