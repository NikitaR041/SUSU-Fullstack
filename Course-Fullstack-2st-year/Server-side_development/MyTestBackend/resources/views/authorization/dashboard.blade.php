<h2>Добро пожаловать, {{ Auth::user()->name }}!</h2>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Выйти</button>
</form>
