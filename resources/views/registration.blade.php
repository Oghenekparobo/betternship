<div>
    <h2>register</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    @endif

    <form method="POST" action="/registration">
        @csrf
        <!-- username, email, and password.  -->
        <label for="username">username:</label>
        <input type="text" name="username">

        <br>
        <label for="emal">email:</label>
        <input type="email" name="email">

        <br>

        <label for="password">password:</label>
        <input type="password" name="password">


        <button>submit</button>
    </form>
</div>