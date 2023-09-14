<form action="{{ route('post.comment.store', ['slug' => $post->slug, 'post' => $post]) }}" method="post" style="max-width: 50%;">
    @csrf
    <div class="form-group">
        <x-input label="Votre message" type="textarea" name="message" rows="4" required/>
        <button type="submit" class="btn btn-primary mt-2">Envoyer</button>
    </div>
</form>
