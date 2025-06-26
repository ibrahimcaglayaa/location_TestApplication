<!DOCTYPE html>
<html lang="en">

@include('include.head')

</head>

<body class="index-page">

<header id="header" class="header d-flex flex-column justify-content-center">

    <i class="header-toggle d-xl-none bi bi-list"></i>

    <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="/" class="active"><i class="bi bi-house navicon"></i><span>Anasayfa</span></a></li>
            <li>
                <a href="#" data-bs-toggle="modal" data-bs-target="#konumModal">
                    <i class="bi bi-pin-fill"></i><span>Konum Ekle</span>
                </a>
            </li>
            <li><a href=""><i class="bi bi-card-list"></i><span>Konum Listele</span></a></li>
        </ul>
    </nav>

</header>


<div class="modal fade" id="konumModal" tabindex="-1" aria-labelledby="konumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="konumModalLabel">Konum Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
                <form id="konumForm">
                    <div class="mb-3">
                        <label for="konumAdi" class="form-label">Konum Adı</label>
                        <input type="text" class="form-control" id="konumAdi" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Enlem (Latitude)</label>
                        <input type="number" class="form-control" id="latitude" name="latitude" step="any" required>
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Boylam (Longitude)</label>
                        <input type="number" class="form-control" id="longitude" name="longitude" step="any" required>
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Marker Rengi</label>
                        <input type="color" class="form-control form-control-color" id="color" name="color" value="#ff0000" title="Renk seçin">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                <button type="submit" form="konumForm" class="btn btn-primary">Kaydey</button>
            </div>
        </div>
    </div>
</div>


<main class="main">


    <section>


    </section>


</main>



<div id="preloader"></div>

<script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
