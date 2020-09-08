<nav class="navbar navbar-expand-md navbar-light" style="background-color: 	#BDB76B;">

    <a href="http://localhost:8000/RD5_Assignment/RD5_Laravel/public/" class="navbar-brand">網銀</a>

    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">

        <ul class="navbar-nav">

            <li class="nav-item index">
                <a href="./" class="nav-link">首頁</a>
            </li>

            <li class="nav-item withdrawal">
                <a href="action?action=withdrawal" class="nav-link">提款</a>
            </li>

            <li class="nav-item deposit">
                <a href="action?action=deposit" class="nav-link">存款</a>
            </li>

            <li class="nav-item detail">
                <a href="detail" class="nav-link">明細</a>
            </li>

            <li class="nav-item">
                <a href="login?logout=1" class="nav-link">登出</a>
            </li>

        </ul>

        <span id="guest">
            <a href="./" class="btn btn-outline-light btn-sm">你好！{{ Session::get('bank_login') }}</a> 
        </span>
    
    </div>
</nav>