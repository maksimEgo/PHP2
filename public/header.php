<header>
    <nav class="navbar">
        <ul class="nav-menu">
            <li><a href="/">Главная</a></li>
            <li><a href="/users/registration">Регистрация</a></li>
        </ul>
    </nav>
</header>

<style>
    header {
        position: fixed;
        top: 0;
        width: 100%;
        background: #333;
        color: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        z-index: 1000;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        margin-top: -5px;
        margin-bottom: -5px;
    }

    .nav-menu {
        list-style: none;
        display: flex;
        margin: 0;
        padding: 0;
    }

    .nav-menu li {
        margin-left: 20px;
    }

    .nav-menu li a {
        color: white;
        text-decoration: none;
        font-size: 16px;
        transition: color 0.3s;
    }

    .nav-menu li a:hover {
        color: #a9a9a9;
    }
</style>