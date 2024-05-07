<div>
    <p>Name: {{ $user->username }}</p>
    <p>Address: {{ $user->email }}</p>
    <p>-------------------------------</p>
    <p>
        cliquer sur ce lien pour confirmer la création de votre compte
        <a href="{{ route('register.confirme', ['token' => $user->confirmation_token]) }}">confirme</a>
    </p>
</div>
