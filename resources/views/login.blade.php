<div>
    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->

    <h2>login</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    @endif

    <form action="/login" method="POST">
        @csrf
        <label for="emal">email:</label>
        <input type="email" name="email">

        <br>

        <label for="password">password:</label>
        <input type="password" name="password">

        <button>submit</button>
    </form>

</div>